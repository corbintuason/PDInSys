import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
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
                name: "Validate",
                responsible: "Validator",
                database_equivalent: ["For Validation", "Returned to Validator"],    
            },
            {
                name: "Payment Approve",
                responsible: "Payment Approver",
                database_equivalent: ["For Payment Approval", "Returned to Payment Approver"],    
            },
            {
                name: "Disburse",
                responsible: "Disburser",
                database_equivalent: ["For Disbursement", "Returned to Disburser"], 
            },
            {
                name: "Acknowledge",
                responsible: "Acknowledger",
                database_equivalent: ["For Acknowledgement", "Returned to Acknowledger"], 
            },
            {
                name: "Close",
                responsible: "Closer",
                database_equivalent: ["For Closing"], 
            },
                  
        ],
    },
    getters: {
    },
    mutations: {},
    actions: {},
});

