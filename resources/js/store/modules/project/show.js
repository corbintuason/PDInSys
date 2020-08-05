import axios from "axios";
import swal from "sweetalert2";
import { app } from "../../../app";
export const showProjectModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Account",
            model: "App\\Project",
            mode: "Show",

            // BELOW ARE FIELDS UNIQUE TO THE MODULE
            item: null,

            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,
        };
    },
    getters: {
        steps(state, getters, rootState) {
            return rootState.project.steps;
        },
        statuses(state, getters, rootState) {
            return rootState.project.statuses;
        },
        project_score_vals(state, getters, rootState) {
            return rootState.project.project_score_vals;
        },
        available_departments(state, getters, rootState) {
            return rootState.project.available_departments;
        },



        getCurrentStep(state, getters) {
            var status = state.item.status;
            var current_step = getters.steps.find((step) => {
                return step.database_equivalent.includes(status);
            });
            return current_step;
        },
        getNextStep(state, getters) {
            var next_step_index =
                state.steps.findIndex(
                    (object) => object.name == getters.getCurrentStep.name
                ) + 1;
            var next_step = state.steps.find(
                (val, index) => index == next_step_index
            );
            return next_step;
        },
        getRemarks(state) {
            return state.item.remarks.sort((a, b) =>
                a.created_at < b.created_at ? 1 : -1
            );
        },
    },
    mutations: {
        storeItem(state, account) {
            state.item = account;
        },
        changeMode(state, mode) {
            state.mode = mode;
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
        changeLoading(state, value) {
            state.loading = value;
        },
    },
    actions: {
        changeMode(context, mode) {
            context.commit("changeMode", mode);
            if (mode == "Show") {
                context.dispatch("storeItem", context.state.item.id);
            }
        },
        storeItem(context, id) {
            context.commit("changeLoading", true);
            return new Promise((resolve, reject) => {
                console.log("aitttttttttttttt");
                console.log(id);
                axios
                    .get("/api/account/" + id)
                    .then((response) => {
                        var account = response.data.data;
                        context.commit("storeItem", account);
                        context.commit("changeLoading", false);
                        context.commit("changeMode", "Show");
                        resolve(account);
                    })
                    .catch((e) => {
                        reject(e);
                    });
            });
        },
        updateItem({ commit, state, getters }) {
            swal.fire({
                title: getters.getCurrentStep.name + " " + state.item.code + "?",
                icon: "question",
                confirmButtonText: getters.getCurrentStep.name,
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                input: "checkbox",
                inputPlaceholder: "Please tick if you skipped this process",
                preConfirm: (checkbox) => {
                    return new Promise((resolve, reject) => {
                        var skipped = {
                            skipped: checkbox,
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
        },
    },
};
