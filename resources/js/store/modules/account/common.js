import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
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
                database_equivalent: ["For Approval", "Returned to Approver"],
            },
        ]
    },
    getters: {
    },
    mutations: {},
    actions: {},
});
