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
                database_equivalent: ["For Approval"],
                action: "For Approval",
                ability_visibility: "review-all-projects"
            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["For Assigning"],
                action: "For Assigning",
                ability_visibility: "approve-all-projects",
            },
            {
                name: "Assigned",
                responsible: "Assigners",
                database_equivalent: ["Assigned"],    
            }
        ]
    },
    getters: {},
    mutations: {},
    actions: {},
});
