import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
export default new Vuex.Store({
    namespaced: true,
    state: {
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
                action: "For Approval",
                ability_visibility: "review-all-cost-estimates"
            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["For Approval", "Returned to Approver"],
                action: "For Clearance",
                ability_visibility: "approve-all-cost-estimates",
            },
            {
                name: "Clearance",
                responsible: "Clearer",
                database_equivalent: ["For Clearance"],
                action: "Cleared",    
                ability_visibility: "clear-all-cost-estimates",
            },
            
        ]
    },
    getters: {},
    mutations: {},
    actions: {},
});
