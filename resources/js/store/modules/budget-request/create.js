export const createBudgetRequestModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Budget Request",
            model: "App\\BudgetRequest",
            mode: null,
            item: null,

            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,

            // BELOW ARE FIELDS UNIQUE TO THE MODULE
            type: null,
            budget_request: {},
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
            categories: [
                {
                    name: "Manpower",
                    types: [
                        "Project Manager", "Coordinator (A.C.)",
                        "Coordinator (Preps)", "Coordinator (I/E)", "Coordinator (Events/Activation)", "Permit Taker / Negotiator", "Push Girl/Boy", "Sampler", "Flyering Agent", "Brand Ambassador / Model", "Telemarketer", "Recorida Manpower", "Helper(Preps)", "Helper (I/E)", "Helper (Events / Activation)", "Bouncers", "Booth Attendants", "Registration Attendants", "Ushers / Usherettes", "Facilitator", "Photographer (Events and Activation)", "Production Staff (1 Team)", "Prod: Floor Director", "Prod: Stage Managers", "Prod: Production Assistant", "Prod: Production Manager", "Prod: Technical Director", "Prod: Lights Director", "Prod: Audio and Sound Spinner", "Prod: Video Spinner / Playback", "Other Manpower", "Talents: Judges", "Talents: DJ / Spinner", "Talents: Host / Emcee", "Talents: Guest Speaker", "Talents: Dancers", "Other Talents"
                    ],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Payroll",
                    types: [
                        "Payroll Item"
                    ],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Meals",
                    types: ["I/E Meals", "Event / Activation Meals", "PDEM Meals", "Other Meals"],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Backchecking",
                    types: [
                        "Transportation Allowance", "Communication Allowance", "Transpo and Com Allowance", "PD REP Allowance", "Other Allowance"
                    ],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Transportation",
                    types: ["Service Van", "I/E Vehicle", "Hauling Vehicle", "Trucking: 4 Wheeler", "Trucking: 6 Wheeler", "Trucking: 10 Wheeler", "Other Vehicle Rental", "Airfare Fees", "Airfreight Fees", "Other Airline Fees"],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Other Rentals",
                    types: [ "Other Rentals / Supplies"],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Materials",
                    types: ["Other Purchases / Supplies"],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Venue Permits",
                    types: ["Other Venue Permits and Fees"],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "HOTAC",
                    types: ["PD HOTAC", "Other Manpower HOTAC", "Other HOTAC Fees"],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Contingency",
                    types: ["Contingency Fund"],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
                {
                    name: "Others",
                    types: ["Others"],
                    entries: [
                        {
                            item: null,
                            description: null,
                            quantity: null,
                            unit: null,
                            unit_price: null,
                            no_of_days: null,
                            no_of_venues: null,
                        },
                    ],
                },
            ],
            units: ["PAX", "TEAM", "LOT", "ROOMS"],
        };
    },
    getters: {
       getTotalBudgetRequest(state, getters){
           var total = 0;
           state.categories.forEach(category => {
                category.entries.forEach(entry => {
                   total +=  (entry.quantity *
                   entry.unit_price *
                   entry.no_of_days *
                   entry.no_of_venues);
                })
           });
        return total;
       },
       getSubTotal(state){

       }
    },
    mutations: {
        addEntry(state, category) {
            var find_category = state.categories.find(
                (module_category) => module_category == category
            );
            find_category.entries.push({
                item: null,
                description: null,
                quantity: null,
                unit: null,
                unit_price: null,
                no_of_days: null,
                no_of_venues: null,
            });
        },
        deleteEntry(state, category) {
            console.log("ano laman nito", category);
                var find_category = state.categories.find(
                    (module_category) => module_category == category.category
                );
                console.log("the fuck is your entry index", category.entry_index);
                find_category.entries.splice(category.entry_index, 1);
        },

    },
    actions: {},
};
