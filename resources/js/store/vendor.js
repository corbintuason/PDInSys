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
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["For Approval", "Returned to Approver"],
                action: "For Assigning",
                ability_visibility: "approve-all-vendors",
            },
        ],
    },
    getters: {},
    mutations: {},
    actions: {},
});
