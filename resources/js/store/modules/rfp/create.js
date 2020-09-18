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
            mode: null,

            loading: false,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,
            show_budget_request_modal: false,

            // BELOW ARE FIELDS UNIQUE TO THE MODULE
            type: null,
            parent: null,

            search_vendor: '',
            item: {
                vendor_id: null,
                erfpables:[
                    {
                        item: null,
                        type: null,
                        reviewer_id: null,
                        billing_amount: 0,
                        reviewers:[]
                    }
                ],

                start_date: null,
                end_date: null,
                description: null,

                venue: null,
                quotation_no: null,
                term_of_payment: {
                    down_payment: {
                        percent: 0,
                        mode_of_payment: null,
                        date_of_release: null,

                        override: 0,
                        vat_exempt_sales: 0,
                        vat_zero_rated_sales: 0
                    },
                    full_payment: {
                        percent: 0,
                        mode_of_payment: "Cash For Deposit",
                        date_of_release: null,

                        override: 0,
                        vat_exempt_sales: 0,
                        vat_zero_rated_sales: 0
                    },


                },
                billing_amount: 0,
                quotation: null,

                vendor: null,
                bank_index: null
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

        getCurrentStep(state, getters) { 
            var status = state.item.status;
            var current_step = getters.steps.find((step) => {
                return step.database_equivalent.includes(status);
            });
            return current_step;
        },
        total_sales(state, getters) {
            return type => {
                if (getters.vat_amount(type) == 0) {
                    return 0;
                } else {

                    var exemption;
                    if (type == "FP") {
                        exemption = state.item.term_of_payment.full_payment
                    } else if (type == "DP") {
                        exemption = state.item.term_of_payment.down_payment;
                    }
                    return getters.vatable_sales(type) + exemption.vat_exempt_sales + exemption.vat_zero_rated_sales + getters.vat_amount(type);
                }
            }

        },
        vat_amount(state, getters) {
            return type => {
                var vat_amount = 0;
                if (state.item.vendor.type_vat == 'VAT Registered') {
                    vat_amount = getters.vatable_sales(type) * 0.12;
                }
                return vat_amount;
            }

        },

        vatable_sales(state, getters) {
            return type => {
                var vatable_sales = 0;
                if (type == "FP") {
                    if (state.item.vendor.type_vat == 'VAT Registered') {

                        vatable_sales = (getters.gross_amount(type) - state.item.term_of_payment.full_payment.vat_exempt_sales - state.item.term_of_payment.full_payment.vat_zero_rated_sales) / 1.12;
                    }

                } else if (type == "DP") {
                    if (state.item.vendor.type_vat == "VAT Registered") {
                        vatable_sales = ((getters.gross_amount(type) / 1.12) - state.item.term_of_payment.down_payment.vat_exempt_sales - state.item.term_of_payment.down_payment.vat_zero_rated_sales);
                    }
                }
                return vatable_sales;
            }

        },

        total_due(state, getters) {
            return type => {
                return getters.total_sales(type) - getters.vat_amount(type);
            }
        },

        witholding_tax(state, getters) {
            return type => {
                var used_percentage = state.item.vendor.ewt_details[0].percent;
                var used_amount = getters.total_due(type);
                if (type == 'FP') {
                    if (state.item.term_of_payment.full_payment.override > 0)
                        used_percentage = state.item.term_of_payment.full_payment.override / 100;
                } else if (type == "DP") {
                    if (state.item.term_of_payment.down_payment.override > 0)
                        used_percentage = state.item.term_of_payment.down_payment.override / 100;
                }

                if (state.item.vendor.type_vat != 'VAT Registered') {
                    used_amount = getters.gross_amount(type);
                }

                console.log("checkign witholding tax");
                console.log("used amount", used_amount);
                console.log("used_percentage", used_percentage);
                return used_amount * used_percentage;
            }

        },

        gross_amount(state, getters) {
            return type => {
                var gross_amount = 0;
                if (type == "FP") {
                    // billing amount - gross amount of down payment
                    gross_amount = state.item.billing_amount - getters.gross_amount("DP")
                } else if (type == "DP") {
                    // Billing Amount * (Down_payment_percent/1000);
                    gross_amount = state.item.billing_amount * ((state.item.term_of_payment.down_payment.percent) / 100);
                }

                return gross_amount;
            }

        },

        amount_due(state, getters) {
            return type => {
                var amount_due = 0;
                if (state.item.vendor.type_vat == 'VAT Registered') {
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

        total_net(state, getters) {

            return getters.net_amount("DP") + getters.net_amount("FP")
        }
    },
    mutations: {
        addItem(state){
            state.item.erfpables.push(
                {
                    item: null,
                    reviewer_id: null,
                    billing_amount: 0,
                    reviewers:[]
                }
            );
        },
        setSearchVendor(state, search){
            state.search_vendor = search;
        },
        addEntry(state, entry) {

            state.item.entries.push(entry);
        },
        deleteEntry(state, category) {
            var entry = state.item.entries.findIndex((entry, index) => {
                return entry.category == category.category && category.entry_index == index
            });
            state.item.entries.splice(entry, 1);
        },
        setEditEntry(state, entry_object) {
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
        setERfpableType(state, type) {
            state.item.erfpable_type = type;
        },
        setERfpableId(state, id) {
            state.item.erfpable_id = id;
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
            if(vendor){
                state.search_vendor = vendor.vendor_name;

            }
        },
        storeItem(state, rfp) {
            state.item = rfp;
        },
        setLoading(state, loading) {
            state.loading = loading;
        },
        setMode(state, mode) {
            state.mode = mode;
        }


    },
    actions: {
        loadParentRequirement({
            commit,
            state
        }, parent_id) {
            if (state.type == 'Project') {
                axios.get("/api/project/" + parent_id).then(response => {
                    var project = response.data.data;
                    commit("setParent", project);

                    commit("setERfpableType", "App\\Project");
                    commit("setERfpableId", project.id);
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

        },

        storeItem({
            commit,
            state
        }, rfp_id, mode) {
            axios.get("/api/erfp/" + rfp_id).then((response) => {

                var rfp = response.data.data;
                commit("storeItem", rfp);
                commit("setLoading", false);
            });
        },

        async createRFP({
            commit,
            state
        }) {
            let response = await axios.get("/api/user", {
                params: {
                    positions: [
                        "Sales and Operations Director", "Project Execution Head"
                    ],
                },

            })
            let reviewers = {};
            await response.data.data.forEach(reviewer => {
                reviewers[reviewer.id] = reviewer.full_name
            });

            const formData = new FormData();

             Object.keys(state.item).forEach((key) => {
                if(key == 'quotation'){
                    console.log("i got in")
                     //1.PROJECTNAME/BUDGETCODE / VENDORNAME / BILL#
                    var file_name = state.parent.name+"_"+state.item.vendor.vendor_name+"_"+state.item.quotation_no;
                      formData.append('quotation', state.item.quotation, file_name);
                    console.log("FILE NAME", file_name);
  
                }else if(key == "term_of_payment"){
                    formData.append(key, JSON.stringify(state.item[key]))
                }
                else{
                    formData.append(key, state.item[key])
                }
            });
            console.log("file?from preconfirm hek", formData);

            const {
                value: reviewer
            } = await swal.fire({
                title: "Create ERFP",
                icon: "question",
                text: "Are you sure you want to create this ERFP?",
                confirmButtonText: "Create ERFP",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                input: 'select',
                inputOptions: reviewers,
                inputPlaceholder: 'Select a Reviewer',
                preConfirm: (reviewer) => {
                    formData.append('reviewer_id', reviewer);
                    formData['reviewer_id'] = reviewer;
                    return new Promise((resolve, reject) => {
                        axios
                            .post("/api/erfp", formData)
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
        setMode({
            commit,
            state,
            getters
        }, mode) {
            commit("setMode", mode);
        },
        // updateItem({
        //     state,
        //     getters
        // }) {
        //     swal.fire({
        //         title: getters.getCurrentStep.name + " " + state.item.code + "?",
        //         icon: "question",
        //         confirmButtonText: getters.getCurrentStep.name,
        //         showLoaderOnConfirm: true,
        //         showCancelButton: true,
        //         cancelButtonColor: "#d33",
        //         allowOutsideClick: false,
        //         input: "checkbox",
        //         inputPlaceholder: "Please tick if you skipped this process",
        //         preConfirm: (checkbox) => {
        //             return new Promise((resolve, reject) => {
        //                 var skipped = {
        //                     skipped: checkbox,
        //                 };
        //                 state.item.skipped = checkbox;
        //                 axios
        //                     .put("/api/erfp/" + state.item.id+"/saveChanges", state.item)
        //                     .then((response) => {
        //                         resolve(response.data);
        //                     })
        //                     .catch((e) => {
        //                         //(e);
        //                         swal.showValidationMessage(
        //                             `Unable to process item`
        //                         );
        //                         swal.hideLoading();
        //                         reject(e);
        //                     });
        //             });
        //         },
        //     }).then((result) => {
        //         if (result.value) {
        //             swal.fire({
        //                 title: result.value.success_text,
        //                 icon: "success",
        //                 onClose: () => {
        //                     app.$router.go();
        //                 },
        //             });
        //         }
        //     });
        // }
        async updateItem({
            commit,
            state,
            getters
        }) {
            const formData = new FormData();

             Object.keys(state.item).forEach((key) => {
                if(key == 'quotation'){
                    console.log("i got in")
                     //1.PROJECTNAME/BUDGETCODE / VENDORNAME / BILL#
                    // var file_name = state.item.name+"_"+state.item.vendor.vendor_name+"_"+state.item.quotation_no;
                    var file_name = "a file name";
                      formData.append('quotation', state.item.quotation, file_name);
                    console.log("FILE NAME", file_name);
  
                }else if(key == "term_of_payment"){
                    formData.append(key, JSON.stringify(state.item[key]))
                }
                else{
                    formData.append(key, state.item[key])
                }
            });
            await swal.fire({
                    title: getters.getCurrentStep.name + " " + state.item.code + "?",
                icon: "question",
                confirmButtonText: getters.getCurrentStep.name,
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                input: "checkbox",
                inputPlaceholder: "Please tick if you skipped this process",
                preConfirm: (reviewer) => {
                    return new Promise((resolve, reject) => {
                        axios
                            .post("/api/erfp/" + state.item.id+"/saveChanges", formData)
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
    },
};
