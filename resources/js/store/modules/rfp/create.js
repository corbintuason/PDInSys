import axios from "axios";
import swal from "sweetalert2";
import {
    app
} from "../../../app"
export const createRFPModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "RFP",
            model: "App\\RFP",
            mode: "Create",

            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,
            show_budget_request_modal: false,

            // BELOW ARE FIELDS UNIQUE TO THE MODULE
            type: null,
            parent: null,
            item: {
                vendor_id: null,
                
                start_date: null,
                end_date: null,
                description: null,

                venue: null,
                quotation_no: null,
                term_of_payment: {
                    full_payment: {
                        percent: null,
                        mode_of_payment: null,
                        date_of_release: null,

                        override: 0,
                        vat_exempt_sales: 0,
                        vat_zero_rated_sales: 0
                    },
                    down_payment: {
                        percent: null,
                        mode_of_payment: null,
                        date_of_release: null,
                        
                        override: 0,
                        vat_exempt_sales: 0,
                        vat_zero_rated_sales: 0
                    },

                },
       

                billing_amount: 0,
                quotations: [],

                vendor: null
            },
        };
    },
    getters: {
        steps(state, getters, rootState) {
            return rootState.rfp.steps;
        },
        getParentName(state) {
            return state.parent.name;
        },
        mode_of_payments(state, getters, rootState) {
            return rootState.rfp.mode_of_payments;
        },


        total_sales(state, getters) {
            return type => {
                if (getters.vat_amount(type) == 0) {
                    return 0;
                } else {
                    //  ₱4,173.21 + ₱500.79			
                    console.log("CHECKING FOR TOTAL SALES")
                    console.log(getters.vatable_sales(type));
                    console.log(getters.vat_amount(type));
                    var exemption;
                    if(type == "FP"){
                        exemption = state.item.term_of_payment.full_payment
                    }
                    else if (type == "DP"){
                        exemption = state.item.term_of_payment.down_payment;
                    }			
                    return getters.vatable_sales(type) + exemption.vat_exempt_sales + exemption. vat_zero_rated_sales + getters.vat_amount(type);
                }
                // if(type == "FP"){
                //     if(getters.vat_amount(type) == 0){
                //         return 0;
                //     } else{
                //         console.log("nice")
                //         console.log(getters.vat_amount(type));
                //         return getters.vatable_sales(type) + getters.vat_amount(type);
                //     }
                // } else if (type == "DP"){

                // }

            }

        },
        vat_amount(state, getters) {
            return type => {
                var vat_amount = 0;
                if (state.item.vendor.type_vat == 'VAT') {
                    vat_amount = getters.vatable_sales(type) * 0.12;
                }
                return vat_amount;
            }

        },				

        vatable_sales(state, getters) {
            return type => {
                var vatable_sales = 0;
                if (type == "FP") {
                    if (state.item.vendor.type_vat == 'VAT') {

                        vatable_sales = (getters.gross_amount(type) - state.item.term_of_payment.full_payment.vat_exempt_sales - state.item.term_of_payment.full_payment.vat_zero_rated_sales) / 1.12;
                    }
                   
                } else if (type == "DP"){
                    if(state.item.vendor.type_vat == "VAT"){
                        vatable_sales = ((getters.gross_amount(type)/1.12) - state.item.term_of_payment.down_payment.vat_exempt_sales - state.item.term_of_payment.down_payment.vat_zero_rated_sales);
                    }
                } return vatable_sales;
            }

        },

        total_due(state, getters) {
            return type => {
                return getters.total_sales(type) - getters.vat_amount(type);
            }
        },
        /**
         * 
         *  Witholding TAX 
            =IF(vat_type="VAT Registered",
            value if vat registered:
            (IF(AD72="",(IFERROR((Z68*AB72),0)),(Z68*AD72))),
            value if not vat registered
            IF(AD72="",(IFERROR((Z88*AB72),0)),(Z88*AD72)))

            var used_percentage = total;
            var used_amount = total;

            if(may laman override){
                used_percentage = override;
            }
            if(vat_type != "Vat registered"){
                used_amount = gross_amount;
            }

            return used_amount*used_percentage
            */

        witholding_tax(state, getters) {
            return type => {
                    var used_percentage = state.item.vendor.ewt_details[0].percent;
                    var used_amount = getters.total_due(type);
                    if(type == 'FP'){
                        console.log("Full Payment");
                        console.log(state.item.term_of_payment.full_payment.override);
                        if(state.item.term_of_payment.full_payment.override > 0)
                        used_percentage = state.item.term_of_payment.full_payment.override/100;
                    } else if (type == "DP"){
                        console.log("Down Payment");
                        console.log(state.item.term_of_payment.down_payment.override);
                        if(state.item.term_of_payment.down_payment.override > 0)
                        used_percentage = state.item.term_of_payment.down_payment.override/100;
                    }

                    if (state.item.vendor.type_vat != 'VAT') {
                        used_amount = getters.gross_amount(type);
                    }
                    
                    console.log("Witholding tax");
                    console.log(used_amount);
                    console.log(used_percentage);
                    return used_amount * used_percentage;
                

            }

        },

        gross_amount(state, getters) {
            return type => {
                var gross_amount = 0;
                if(type == "FP"){
                    // billing amount - gross amount of down payment
                    gross_amount = state.item.billing_amount - getters.gross_amount("DP")
                } else if (type == "DP"){
                   gross_amount = state.item.billing_amount*((state.item.term_of_payment.down_payment.percent)/100);
                }

                return gross_amount;
            }

        },

        amount_due(state, getters) {
            return type => {
                    var amount_due = 0;
                    if (state.item.vendor.type_vat == 'VAT') {
                        amount_due = getters.total_due(type) - getters.witholding_tax(type);
                    }
                    return amount_due;
                
            }

        },

        total_amount_due(state, getters) {
            return type => {
               return getters.amount_due(type) + getters.vat_amount(type);

            }
        },

        net_amount(state, getters) {
            return type => {
                return getters.gross_amount(type) - getters.witholding_tax(type);
            }
        },

        total_net(state, getters){
            console.log("Ito ba", getters.net_amount("DP"));
            console.log("or ito", getters.net_amount("FP"));
            return getters.net_amount("DP") + getters.net_amount("FP")
        }
    },
    mutations: {
        addEntry(state, entry) {
            console.log("check if pushed");
            console.log(entry);
            state.item.entries.push(entry);
        },
        deleteEntry(state, category) {
            var entry = state.item.entries.findIndex((entry, index) => {
                return entry.category == category.category && category.entry_index == index
            });
            state.item.entries.splice(entry, 1);
        },
        setEditEntry(state, entry_object) {
            console.log("awit", entry_object);
            state.edit_entry = entry_object.entry;
            state.edit_category = entry_object.category
        },
        setType(state, type) {
            state.type = type;
        },
        setParent(state, parent) {
            state.parent = parent;
            state.loading = false;
        },
        setStartDate(state, start_date) {
            state.item.start_date = start_date;
        },
        setEndDate(state, end_date) {
            state.item.end_date = end_date;
        },
        setRfpableType(state, type) {
            state.item.brable_type = type;
        },
        setRfpableId(state, id) {
            state.item.brable_id = id;
        },
        selectVendor(state, vendor) {
            if (vendor != null) {
                state.item.vendor_id = vendor.id;
            } else {
                state.item.vendor_id = null;
            }
        },
        setVendor(state, vendor) {
            state.item.vendor = vendor;
        }

    },
    actions: {
        loadParentRequirement({
            commit,
            state
        }, parent_id) {
            if (state.type == 'Project') {
                console.log("hmm");
                axios.get("/api/project/" + parent_id).then(response => {
                    var project = response.data.data;
                    commit("setParent", project);
                    commit("setRfpableType", "App\\Project");
                    commit("setRfpableId", project.id);
                });
            } else if (state.type == 'Account') {
                // axios.get("/api/account/"+parent_id).then(response => {
                //     var project = response.data.data;
                //     commit("setParent", project);
                // });      
            }
        },

        selectVendor({
            commit,
            state
        }, vendor) {
            commit("selectVendor", vendor);
            commit("setVendor", vendor);
            console.log(state.selected_vendor, state.item.vendor_id);

        },
        createRFP({
            commit,
            state
        }) {
            console.log("rfp", state.item);
            swal.fire({
                title: "Create RFP",
                icon: "question",
                text: "Are you sure you want to create this RFP?",
                confirmButtonText: "Create RFP",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .post("/api/rfp", state.item)
                            .then((response) => {
                                resolve(response.data);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to process item`
                                );
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    swal.fire({
                        title: result.value.success_text,
                        icon: "success",
                        onClose: () => {
                            app.$router.push({
                                name: "rfp_show",
                                params: {
                                    id: result.value.item_id
                                },
                            });
                        },
                    });
                }
            });
        },
        updateStatus() {

        }
    },
};
