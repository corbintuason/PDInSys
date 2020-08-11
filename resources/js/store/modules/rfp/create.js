import axios from "axios";
import swal from "sweetalert2";
import {app} from "../../../app"
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
                rfp_date: null,

                start_date: null,
                end_date: null,
                description: null,

                venue: null,
                quotation_no: null,
                term_of_payment:{
                    percent: null,
                    quotation_no: null,
                    date_of_release: null
                },
              
                billing_amount: 0
            },
            selected_vendor: null
  
        };
    },
    getters: {
       steps(state, getters, rootState){
        return rootState.rfp.steps;
       },
       getParentName(state){
           return state.parent.name;
       },
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
        setEditEntry(state, entry_object){
            console.log("awit", entry_object);
            state.edit_entry = entry_object.entry;
            state.edit_category = entry_object.category
        },
        setType(state, type){
            state.type = type;
        },
        setParent(state, parent){
            state.parent = parent;
            state.loading = false;
        },
        setStartDate(state, start_date){
            state.item.start_date = start_date;
        },
        setEndDate(state, end_date){
            state.item.end_date = end_date;
        },
        setRfpableType(state, type){
            state.item.brable_type = type;
        },
        setRfpableId(state, id){
            state.item.brable_id = id;
        },
        selectVendor(state, vendor){
            if(vendor!=null){
                state.item.vendor_id = vendor.id;
            }else{
                state.item.vendor_id = null;
            }
        },
        setVendor(state, vendor){
            state.selected_vendor = vendor;
            console.log(state.selected_vendor, state.item.vendor_id);

        }

    },
    actions: {
        loadParentRequirement({commit, state}, parent_id){
            if(state.type == 'Project'){
                console.log("hmm");
                axios.get("/api/project/"+parent_id).then(response => {
                    var project = response.data.data;
                    commit("setParent", project);
                    commit("setRfpableType", "App\\Project");
                    commit("setRfpableId", project.id);
                });                  
            }else if (state.type =='Account'){
                // axios.get("/api/account/"+parent_id).then(response => {
                //     var project = response.data.data;
                //     commit("setParent", project);
                // });      
            }
        },

        selectVendor({commit, state}, vendor){
            commit("selectVendor", vendor);
            commit("setVendor", vendor);
            console.log(state.selected_vendor, state.item.vendor_id);

        },
        createRFP({commit, state}){
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
                                params: { id: result.value.item_id },
                            });
                        },
                    });
                }
            });
        },
        updateStatus(){
            
        }
    },
};
