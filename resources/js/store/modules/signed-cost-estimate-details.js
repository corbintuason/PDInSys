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
                database_equivalent: ["For Creation", "Returned to Creator"],
            },
            {
                name: "Review",
                responsible: "Reviewer",
                database_equivalent: ["For Review", "Returned to Reviewer"],
            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["For Approval", "Returned to Approver"],
            },
            {
                name: "Clear",
                responsible: "Clearer",
                database_equivalent: ["For Clearance"],
            },
            {
                name: "Cleared",
                responsible: null,
                database_equivalent: ["Cleared"]
            },       
        ]
    },
    getters: {},
    mutations: {},
    actions: {},
});
