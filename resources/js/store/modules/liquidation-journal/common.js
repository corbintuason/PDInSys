import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        steps: [
            {
                name: "Create",
                responsible: "Creator",
                database_equivalent: [
                    "For Creation",
                    "Returned to Creator",
                ],
            },
            {
                name: "Validate",
                responsible: "Validator",
                database_equivalent: [
                    "For Validation",
                    "Returned to Validator",
                ],
            },
            {
                name: "Recommend",
                responsible: "Recommender",
                database_equivalent: [
                    "For Recommendation",
                    "Returned to Recommender",
                ],
            },
            {
                name: "Clear",
                responsible: "Clearer",
                database_equivalent: [
                    "For Clearance",
                    "Returned to Clearer",
                ],
            },
            {
                name: "Audit",
                responsible: "Auditor",
                database_equivalent: [
                    "For Auditing",
                    "Returned to Auditor",
                ],
            },
        ],
    },
    getters: {
    },
    mutations: {},
    actions: {},
});
