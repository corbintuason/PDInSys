import axios from "axios";
import swal from "sweetalert2";
import {app} from "../../../app"
export const createBudgetRequestModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Budget Request",
            model: "App\\BudgetRequest",
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
                brable_type: null,
                brable_id: null,
                ce_number_id: null,
                start_date: null,
                end_date: null,
                entries:[
                ],
            },
            edit_entry: null,
            edit_category: null,
  
        };
    },
    getters: {
       categories(state, getters, rootState){
        return rootState.budgetRequest.categories;
       },
       steps(state, getters, rootState){
        return rootState.budgetRequest.steps;
       },
       units(state, getters, rootState){
           return rootState.budgetRequest.units;
       },
       account_manager(state){
        var account_manager = state.parent.core_team.find(member => member.type == 'Main Account Manager').user;
        return account_manager.last_name + ", " + account_manager.first_name;
       },
       getTotalBudgetRequest(state, getters){
        var total = 0;
        state.item.entries.forEach((entry) => {
            total +=
                entry.quantity *
                entry.unit_price *
                entry.no_of_days *
                entry.no_of_venues;
        });
        return total;
       },
       getParentName(state){
           return state.parent.name;
       },
       budget_limit(state){
        // For Project
        var budget_limit = 0;
        console.log("ito ba");
        console.log(state.parent);
        state.parent.cost_estimate.cleared_ce_details.forEach(ce_detail => {
            budget_limit += ce_detail.signed_ce_detail.internal_budget
        });
        return budget_limit;
       },
       reached_budget_limit(state, getters){
           return getters.getTotalBudgetRequest > state.parent.total_remaining_budget;
       },
    cleared_ces(state){
        return state.parent.cost_estimate.cleared_ce_details
        },
    account_manager(state){
        var account_manager = state.parent.core_team.find(member => member.type == 'Main Account Manager').user;
        return account_manager.last_name + ", " + account_manager.first_name;
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
        setBrableType(state, type){
            state.item.brable_type = type;
        },
        setBrableId(state, id){
            state.item.brable_id = id;
        },
        changeShowBudgetRequestModal(state, show){
            console.log("here");
            state.show_budget_request_modal = show;
            console.log(state.show_budget_request_modal);
        }

    },
    actions: {
        loadParentRequirement({commit, state}, parent_id){
            if(state.type == 'Project'){
                console.log("hmm");
                axios.get("/api/project/"+parent_id).then(response => {
                    var project = response.data.data;
                    commit("setParent", project);
                    commit("setBrableType", "App\\Project");
                    commit("setBrableId", project.id);
                });                  
            }else if (state.type =='Account'){
                // axios.get("/api/account/"+parent_id).then(response => {
                //     var project = response.data.data;
                //     commit("setParent", project);
                // });      
            }
        },
        createBudgetRequest({commit, state}){
            console.log("budget request", state.item);
            swal.fire({
                title: "Create Budget Request",
                icon: "question",
                text: "Are you sure you want to create this Budget Request?",
                confirmButtonText: "Create Budget Request",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .post("/api/budget_request", state.item)
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
                                name: "budget_request_show",
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
