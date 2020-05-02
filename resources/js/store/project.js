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
                ability_visibility: "review-all-projects"
            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["For Approval", "Returned to Approver"],
                action: "For Assigning",
                ability_visibility: "approve-all-projects",
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
