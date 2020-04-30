import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({
    namespaced: true,
    state: {
        steps: [
            {
                name: "Create",
                responsible: "Creator",
                database_equivalent: ["For Review", "Returned"],
            },
            {
                name: "Review",
                responsible: "Reviewer",
                database_equivalent: ["For Approval"]
            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["Approved"]
            },
            {
                name: "Assigned",
                responsible: "Assigners",
                database_equivalent: ["Assigned"]
            }
        ]
    },
    getters: {},
    mutations: {},
    actions: {},
});
