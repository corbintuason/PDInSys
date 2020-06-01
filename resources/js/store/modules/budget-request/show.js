import axios from "axios";
export const showBudgetRequestModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Budget Request",
            model: "App\\BudgetRequest",
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
                    database_equivalent: ["For Review", "Returned to Approver"],
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
                    name: "Release",
                    responsible: "Release",
                    database_equivalent: [
                        "For Release",
                        "Returned to Releaser",
                    ],
                },
                {
                    name: "Disubrse",
                    responsible: "Disburser",
                    database_equivalent: [
                        "For Disbursement",
                        "Returned to Disburser",
                    ],
                },
            ],
        
            units: ["PAX", "TEAM", "LOT", "ROOMS"],
        };
    },
    getters: {
       getTotalBudgetRequest(state, getters){
           var total = 0;
           state.item.categories.forEach(category => {
                category.entries.forEach(entry => {
                   total +=  (entry.quantity *
                   entry.unit_price *
                   entry.no_of_days *
                   entry.no_of_venues);
                })
           });
        return total;
       },
       active_categories(state){
           return state.item.categories.filter(category => category.entries.length > 0)
       },
       getParentName(state){
           return state.item.parent.name;
       },
       getCurrentStep(state) {
        var status = state.item.status;
        var current_step = state.steps.find((step) => {
            return step.database_equivalent.includes(status);
        });
        return current_step;
    },
    getEndpoints(state){
        var endpoints = {
            api: "/api/budget_request/"+state.item.id,
            show_route: "budget_request_show"
        };

        return endpoints;
    },
    },
    mutations: {
        storeItem(state, budget_request){
            console.log("so ala ako");
            state.item = budget_request;
            console.log(state.item.remarks);
        },
        addEntry(state, category) {
            var find_category = state.budget_request.categories.find(
                (module_category) => module_category == category
            );
            find_category.entries.push({
                type: null,
                description: null,
                quantity: null,
                unit: null,
                unit_price: null,
                no_of_days: null,
                no_of_venues: null,
            });
        },
        deleteEntry(state, category) {
            console.log("ano laman nito", category);
                var find_category = state.budget_request.categories.find(
                    (module_category) => module_category == category.category
                );
                console.log("the fuck is your entry index", category.entry_index);
                find_category.entries.splice(category.entry_index, 1);
        },

        setStartDate(state, start_date){
            state.budget_request.start_date = start_date;
        },
        setEndDate(state, end_date){
            state.budget_request.end_date = end_date;
        },
        setLoading(state, loading){
            state.loading = loading;
        },
        changeMode(state, mode){
            console.log("changing status of this project", state.mode);
            state.mode = mode;
            console.log("did it change?", state.mode);
        },
        changeShowReturnModal(state, status){
            console.log("is something happening");
            state.show_return_modal = status;
            console.log(state.show_return_modal);
        },
        changeShowRejectModal(state, status){
            state.show_reject_modal = status;
        },
        changeShowRemarksModal(state, status){
            console.log("remarks modal", state.show_remarks_modal);
            state.show_remarks_modal = status;
            console.log("should change", state.show_remarks_modal);
        }
    },
    actions: {
       storeItem({commit, state}, br_id){
        axios.get('/api/budget_request/'+br_id).then(response => {
            var budget_request = response.data.data;
            commit('storeItem', budget_request);
            commit("setLoading", false);
        })
       }
    },
};
