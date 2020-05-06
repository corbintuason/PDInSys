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
                action: "For Review",
                ability_visibility: "create-projects",
                can_return: ["review-all-projects", "approve-all-projects"]
            },
            {
                name: "Review",
                responsible: "Reviewer",
                database_equivalent: ["For Review", "Returned to Reviewer"],
                action: "For Approval",
                ability_visibility: "review-all-projects",
                can_return: ["approve-all-projects"]

            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["For Approval", "Returned to Approver"],
                action: "For Assigning",
                ability_visibility: "approve-all-projects",
                can_return: ["assign-all-projects"]
            },
            {
                name: "Assigned",
                responsible: "Assigners",
                database_equivalent: ["For Assigning"],    
            },
            
        ]
    },
    getters: {},
    mutations: {},
    actions: {},
});
