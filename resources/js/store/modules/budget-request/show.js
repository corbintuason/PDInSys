import axios from "axios";
import swal from "sweetalert2";
import {app} from "../../../app";

export const showBudgetRequestModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Budget Request",
            model: "App\\BudgetRequest",
            mode: "Show",

            item: null,
            edit_entry: null,
            edit_category: null,

            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,
            show_release_modal: false,
            show_disbursement_modal: false,
            show_liqudation_journal_modal: false,
            

            tags: ["VAT", "Non-VAT", "AR"],

            liquidation_journal: {},
        };
    },
    getters: {
        categories(state, getters, rootState) {
            return rootState.budgetRequest.categories;
        },
        steps(state, getters, rootState) {
            return rootState.budgetRequest.steps;
        },
        units(state, getters, rootState) {
            return rootState.budgetRequest.units;
        },
        getTotalBudgetRequest(state, getters) {
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
        budget_limit(state) {
            // For Project
            state.item.parent.cost_estimate.cleared_ce_details.forEach(
                (ce_detail) => {
                    budget_limit += ce_detail.signed_ce_detail.internal_budget;
                }
            );
            return budget_limit;
        },
        reached_budget_limit(state, getters){
            return getters.getTotalBudgetRequest > state.item.parent.total_remaining_budget;
        },
        active_categories(state) {
            return state.item.categories.filter(
                (category) => category.entries.length > 0
            );
        },
        getParentName(state) {
            console.log("maybe...??");
            return state.item.parent.name;
        },
        getCurrentStep(state, getters) {
            var status = state.item.status;
            var current_step = getters.steps.find((step) => {
                return step.database_equivalent.includes(status);
            });
            return current_step;
        },
        getEndpoints(state) {
            var endpoints = {
                api: "/api/budget_request/" + state.item.id,
                show_route: "budget_request_show",
            };

            return endpoints;
        },
        cleared_ces(state) {
            return state.item.parent.cost_estimate.cleared_ce_details;
        },
        account_manager(state) {
            var account_manager = state.item.parent.core_team.find(
                (member) => member.type == "Main Account Manager"
            ).user;
            return (
                account_manager.last_name + ", " + account_manager.first_name
            );
        },
    },
    mutations: {
        changeMode(state, mode){
            state.mode = mode;
        },
        storeItem(state, budget_request) {
            console.log("so ala ako");
            state.item = budget_request;
            console.log(state.item.remarks);
        },
        addEntry(state, entry) {
            console.log("check if pushed");
            console.log(entry);
            state.item.entries.push(entry);
        },
        deleteEntry(state, category) {
            var find_category = state.budget_request.categories.find(
                (module_category) => module_category == category.category
            );
            console.log("the fuck is your entry index", category.entry_index);
            find_category.entries.splice(category.entry_index, 1);
        },
        setEditEntry(state, entry_object){
            console.log("awit", entry_object);
            state.edit_entry = entry_object.entry;
            state.edit_category = entry_object.category
        },
        setStartDate(state, start_date) {
            state.budget_request.start_date = start_date;
        },
        setEndDate(state, end_date) {
            state.budget_request.end_date = end_date;
        },
        setLoading(state, loading) {
            state.loading = loading;
        },
        changeMode(state, mode) {
            console.log("changing status of this project", state.mode);
            state.mode = mode;
            console.log("did it change?", state.mode);
        },
        changeShowReturnModal(state, status) {
            console.log("is something happening");
            state.show_return_modal = status;
            console.log(state.show_return_modal);
        },
        changeShowRejectModal(state, status) {
            state.show_reject_modal = status;
        },
        changeShowRemarksModal(state, status) {
            console.log("remarks modal", state.show_remarks_modal);
            state.show_remarks_modal = status;
            console.log("should change", state.show_remarks_modal);
        },
        changeShowReleaseModal(state, status){
            state.show_release_modal = status;
        },
        changeShowDisbursementModal(state, status){
            state.show_disbursement_modal = status;
        }
    },
    actions: {
        changeMode({commit, state}, mode){
            commit("changeMode", mode);
        },
        storeItem({ commit, state }, br_id) {
            axios.get("/api/budget_request/" + br_id).then((response) => {
                var budget_request = response.data.data;
                commit("storeItem", budget_request);
                commit("setLoading", false);
            });
        },
        updateItem({ commit, state, getters }){
            if(state.item.status == 'For Release'){
               commit("changeShowReleaseModal", true);
            } else if (state.item.status == 'For Disbursement'){
                console.log("hm?")
                commit("changeShowDisbursementModal", true);
            }
            else{
                swal.fire({
                    title: getters.getCurrentStep.name + " " + state.name +"?",
                    icon: "question",
                    confirmButtonText: getters.getCurrentStep.name,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    allowOutsideClick: false,
                    input: 'checkbox',
                    inputPlaceholder: 'Please tick if you skipped this process',
                    preConfirm: (checkbox) => {
                        return new Promise((resolve, reject) => {
                            var skipped = {
                                skipped: checkbox
                            };
                            axios
                                .put(getters.getEndpoints.api, skipped)
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
                        console.log(result);
                        swal.fire({
                            title: result.value.success_text,
                            icon: "success",
                            onClose: () => {
                                app.$router.go();
                            },
                        });
                    }
                });
            }
        }
    },
};
