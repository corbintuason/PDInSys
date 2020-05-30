export const unsignedCostEstimateDetailModule = {
    namespaced: true,
    state() {
        return {
            name: "Cost Estimate Detail",
            model: "App\\CostEstimateDetail",
            mode: "Show",
            item: null,
            
            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,
            steps: [
                {
                    name: "Create",
                    responsible: "Creator",
                    database_equivalent: ["Returned to Creator"],
                },
                {
                    name: "Review",
                    responsible: "Reviewer",
                    database_equivalent: ["For Review", "Returned to Reviewer"],
                },
                {
                    name: "Approve",
                    responsible: "Approver",
                    database_equivalent: [
                        "For Approval",
                        "Returned to Approver",
                    ],
                },
                {
                    name: "Clear",
                    responsible: "Clearer",
                    database_equivalent: ["For Clearance"],
                },
            ],
        };
    },
    getters: {
        getActionName(state, getters){
            return getters.getCurrentStep.name + " " + state.name;
        },
        getEndpoints(state){
            var endpoints = {
                api: "/api/cost_estimate_detail/" + state.item.id,
            };

            return endpoints;
        },
        getCurrentStep(state) {
            var status = state.item.status;
            var current_step = state.steps.find((step) => {
                return step.database_equivalent.includes(status);
            });
            return current_step;
        },
    },
    mutations: {
        storeItem(state, detail){
            console.log("detail?", state.item);
            state.item = detail;
            console.log("updated sana", state.item);
        },
        changeShowReturnModal(state, status){
            console.log("is something happening");
            state.show_return_modal = status;
            console.log(state.show_return_modal);
        },
    },
    actions: {
        storeItem(context, detail) {
            context.commit("storeItem", detail);
        },
    },
};
