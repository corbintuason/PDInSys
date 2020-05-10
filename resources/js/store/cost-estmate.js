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
                name: "Sign",
                responsible: "Signer",
                database_equivalent: ["For Signing"]
            },
            {
                name: "Review",
                responsible: "Reviewer",
                database_equivalent: ["For Review (Signed)", "Returned to Reviewer (Signed)"],
            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["For Approval (Signed)", "Returned to Approver (Signed)"],
            },
            {
                name: "Clear",
                responsible: "Clearer",
                database_equivalent: ["For Clearance (Signed)", "Returned to Clearer (Signed)"],
            },
            {
                name: "Cleared",
                responsible: null,
                database_equivalent: ["Cleared (Signed)"]
            }
            
        ]
    },
    getters: {},
    mutations: {},
    actions: {},
});
