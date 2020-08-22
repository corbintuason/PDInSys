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
                name: "RFP Approve",
                responsible: "RFP Approver",
                database_equivalent: ["For RFP Approval", "Returned to Approver"],
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
        
        mode_of_payments:[
            { value: null, text: 'N/A' },
            { value: "Cash For Deposit", text: 'Cash For Deposit' },
            { value: "Cash for Pick-Up", text: "Cash for Pick-Up" },
            { value: "Check", text: "Check"}
        ]
    },
    getters: {
    },
    mutations: {},
    actions: {},
});

