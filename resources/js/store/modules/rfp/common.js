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
                visible: false,
        
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
                name: "Payment Processing",
                responsible: "Payment Processor",
                database_equivalent: ["For Payment Processing", "Returned to Payment Processor"], 
                visible: false,

            },
            {
                name: "Close",
                responsible: "Closer",
                database_equivalent: ["For Closing"], 
                visible: false
            },
                  
        ],
        
        mode_of_payments:[
            { value: "Cash For Deposit", text: 'Cash For Deposit'},
            { value: "Cash for Pick-Up", text: "Cash for Pick-Up"},
            { value: "Check", text: "Check"}
        ]
    },
    getters: {
    },
    mutations: {},
    actions: {},
});

