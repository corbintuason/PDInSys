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
                database_equivalent: ["For Review", "Returned to Approver"],
            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: [
                    "For Approval",
                    "Returned to Approver",
                ],
            },
            {
                name: "Release",
                responsible: "Release",
                database_equivalent: [
                    "For Release",
                    "Returned to Releaser",
                ],
            },
            {
                name: "Disubrse",
                responsible: "Disburser",
                database_equivalent: [
                    "For Disbursement",
                    "Returned to Disburser",
                ],
            },
        ],
        units: ["PAX", "TEAM/S", "LOT", "ROOM/S", "SET/S", "PC/S", "PACKAGE", "UNIT/S"],
        categories: [
            {
                name: "Manpower",
                types: [
                    "Project Manager", "Coordinator (A.C.)",
                    "Coordinator (Preps)", "Coordinator (I/E)", "Coordinator (Events/Activation)", "Permit Taker / Negotiator", "Push Girl/Boy", "Sampler", "Flyering Agent", "Brand Ambassador / Model", "Telemarketer", "Recorida Manpower", "Helper(Preps)", "Helper (I/E)", "Helper (Events / Activation)", "Bouncers", "Booth Attendants", "Registration Attendants", "Ushers / Usherettes", "Facilitator", "Photographer (Events and Activation)", "Production Staff (1 Team)", "Prod: Floor Director", "Prod: Stage Managers", "Prod: Production Assistant", "Prod: Production Manager", "Prod: Technical Director", "Prod: Lights Director", "Prod: Audio and Sound Spinner", "Prod: Video Spinner / Playback", "Other Manpower", "Talents: Judges", "Talents: DJ / Spinner", "Talents: Host / Emcee", "Talents: Guest Speaker", "Talents: Dancers", "Other Talents"
                ]
            },
            {
                name: "Payroll",
                types: [
                    "Payroll Item"
                ],
            },
            {
                name: "Meals",
                types: ["I/E Meals", "Event / Activation Meals", "PDEM Meals", "Other Meals"],
            },
            {
                name: "Backchecking",
                types: [
                    "Transportation Allowance", "Communication Allowance", "Transpo and Com Allowance", "PD REP Allowance", "Other Allowance"
                ],
            },
            {
                name: "Transportation",
                types: ["Service Van", "I/E Vehicle", "Hauling Vehicle", "Trucking: 4 Wheeler", "Trucking: 6 Wheeler", "Trucking: 10 Wheeler", "Other Vehicle Rental", "Airfare Fees", "Airfreight Fees", "Other Airline Fees"],
            },
            {
                name: "Other Rentals",
                types: [ "Other Rentals / Supplies"],
            },
            {
                name: "Materials",
                types: ["Other Purchases / Supplies"],
            },
            {
                name: "Venue Permits",
                types: ["Other Venue Permits and Fees"],
            },
            {
                name: "HOTAC",
                types: ["PD HOTAC", "Other Manpower HOTAC", "Other HOTAC Fees"],
            },
            {
                name: "Contingency",
                types: ["Contingency Fund"],
            },
            {
                name: "Others",
                types: ["Others"],
            },
        ],

    },
    getters: {
    },
    mutations: {},
    actions: {},
});
