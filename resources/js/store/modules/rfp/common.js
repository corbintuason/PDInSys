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
                visible: true
            },
            {
                name: "Review",
                responsible: "Reviewer",
                database_equivalent: ["For Review", "Returned to Reviewer"],
        
            },
            {
                name: "ERFP Approve",
                responsible: "ERFP Approver",
                database_equivalent: ["For ERFP Approval", "Returned to Approver"],
                visible: false,
            },
            {
                name: "Validate",
                responsible: "Validator",
                database_equivalent: ["For Validation", "Returned to Validator"],
                visible: true,
            },
            {
                name: "Payment Approve",
                responsible: "Payment Approver",
                database_equivalent: ["For Payment Approval", "Returned to Payment Approver"],    
                visible: true,

            },
            {
                name: "Disburse",
                responsible: "Disburser",
                database_equivalent: ["For Disbursement", "Returned to Disburser"], 
                visible: true,

            },
            {
                name: "Acknowledge",
                responsible: "Acknowledger",
                database_equivalent: ["For Acknowledgement", "Returned to Acknowledger"], 
                visible: true,

            },
            {
                name: "Close",
                responsible: "Closer",
                database_equivalent: ["For Closing"], 
            },
                  
        ],
        
        mode_of_payments:[
            { value: null, text: 'N/A', disabled: true},
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

