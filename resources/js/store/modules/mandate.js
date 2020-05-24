import axios from "axios";

export const mandateModule = {
    namespaced: true,
    state() {
        return {
            name: "Mandate",
            model: "App\\Mandate",
            mode: null,
            item: null,

            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: false,
            steps: [
                {
                    name: "Create",
                    responsible: "Creator",
                    visible: true,
                    database_equivalent: ["Returned to Creator"],
                },
                {
                    name: "Approve",
                    responsible: "Approver",
                    database_equivalent: [
                        "For Approval",
                        "Returned to Approver",
                    ],
                },
            ],
        };
    },
    getters: {
        getActionName(state, getters) {
            return getters.getCurrentStep.name + " " + state.name;
        },
        getCurrentStep(state) {
            var status = state.item.status;
            var current_step = state.steps.find((step) => {
                return step.database_equivalent.includes(status);
            });
            return current_step;
        },
        getNextStep(state, getters) {
            console.log(state.steps, "the steps (?)");
            var next_step_index =
                state.steps.findIndex(
                    (object) => object.name == getters.getCurrentStep.name
                ) + 1;
            var next_step = state.steps.find(
                (val, index) => index == next_step_index
            );
            return next_step;
        },
        getEndpoints(state) {
            var endpoints = {
                api: "/api/mandate/" + state.item.id,
            };

            return endpoints;
        },
        getClients(state) {
            return state.item.clients;
        },
        getRemarks(state) {
            return state.item.remarks.sort((a, b) =>
                a.created_at < b.created_at ? 1 : -1
            );
        },
    },
    mutations: {
        storeItem(state, mandate) {
            state.item = mandate;
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
                context.dispatch("storeMandate", context.state.item.id);
            }
        },
        storeItem(context, id) {
            context.commit("changeLoading", true);
            return new Promise((resolve, reject) => {
                console.log("aitttttttttttttt");
                console.log(id);
                axios
                    .get("/api/mandate/" + id)
                    .then((response) => {
                        var mandate = response.data.data;
                        context.commit("storeItem", mandate);
                        context.commit("changeLoading", false);
                        context.commit("changeMode", "Show");
                        resolve(mandate);
                    })
                    .catch((e) => {
                        reject(e);
                    });
            });
        },
    },
};
