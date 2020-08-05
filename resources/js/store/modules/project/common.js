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
                name: "Assign",
                responsible: "Assigners",
                database_equivalent: ["For Assigning"],    
            },   
        ],
        statuses: [
            "Pitch / Bid Preparation",
            "Awaiting for Bid Results",
            "Loss Bid",
            "Pre-Awarded",
            "Awarded",
            "Ongoing",
            "Fully-Delivered / Completed",
            "Closed",
        ],
        project_score_vals: {
            min: 1,
            max: 10,
        },
                 
        available_departments: [
            {
                text: "Accounts and Business Development",
                value: {
                    name: "Accounts and Business Development Team",
                    main: "Main Account Manager",
                    deputy: "Deputy Account Manager",
                },
            },
            {
                text: "Project Execution",
                value: {
                    name: "Project Execution Team",
                    main: "Main Project Manager",
                    deputy: "Deputy Project Writer",
                },
            },
            {
                text: "Creatives - Copy and Digital",
                value: {
                    name: "Copy and Digital Team",
                    main: "Main Creative Writer",
                    deputy: "Deputy Creative Writer",
                },
            },
            {
                text: "Creatives - Design and Multimedia",
                value: {
                    name: "Design and Multimedia Team",
                    main: "Main Graphic Artist",
                    deputy: "Deputy Graphic Artist",
                },
            },
        ],
    },
    getters: {
    },
    mutations: {},
    actions: {},
});

