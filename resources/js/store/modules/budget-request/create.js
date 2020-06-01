import axios from "axios";
export const createBudgetRequestModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Budget Request",
            model: "App\\BudgetRequest",
            mode: "Create",

            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,

            // BELOW ARE FIELDS UNIQUE TO THE MODULE
            type: null,
            parent: null,
            budget_request: {
                brable_type: null,
                brable_id: null,
                start_date: null,
                end_date: null,
                categories: [
                    {
                        name: "Manpower",
                        types: [
                            "Project Manager", "Coordinator (A.C.)",
                            "Coordinator (Preps)", "Coordinator (I/E)", "Coordinator (Events/Activation)", "Permit Taker / Negotiator", "Push Girl/Boy", "Sampler", "Flyering Agent", "Brand Ambassador / Model", "Telemarketer", "Recorida Manpower", "Helper(Preps)", "Helper (I/E)", "Helper (Events / Activation)", "Bouncers", "Booth Attendants", "Registration Attendants", "Ushers / Usherettes", "Facilitator", "Photographer (Events and Activation)", "Production Staff (1 Team)", "Prod: Floor Director", "Prod: Stage Managers", "Prod: Production Assistant", "Prod: Production Manager", "Prod: Technical Director", "Prod: Lights Director", "Prod: Audio and Sound Spinner", "Prod: Video Spinner / Playback", "Other Manpower", "Talents: Judges", "Talents: DJ / Spinner", "Talents: Host / Emcee", "Talents: Guest Speaker", "Talents: Dancers", "Other Talents"
                        ],
                        entries: [
                        ],
                    },
                    {
                        name: "Payroll",
                        types: [
                            "Payroll Item"
                        ],
                        entries: [
                        ],
                    },
                    {
                        name: "Meals",
                        types: ["I/E Meals", "Event / Activation Meals", "PDEM Meals", "Other Meals"],
                        entries: [
                        ],
                    },
                    {
                        name: "Backchecking",
                        types: [
                            "Transportation Allowance", "Communication Allowance", "Transpo and Com Allowance", "PD REP Allowance", "Other Allowance"
                        ],
                        entries: [
    
                        ],
                    },
                    {
                        name: "Transportation",
                        types: ["Service Van", "I/E Vehicle", "Hauling Vehicle", "Trucking: 4 Wheeler", "Trucking: 6 Wheeler", "Trucking: 10 Wheeler", "Other Vehicle Rental", "Airfare Fees", "Airfreight Fees", "Other Airline Fees"],
                        entries: [
                        ],
                    },
                    {
                        name: "Other Rentals",
                        types: [ "Other Rentals / Supplies"],
                        entries: [
                        ],
                    },
                    {
                        name: "Materials",
                        types: ["Other Purchases / Supplies"],
                        entries: [
                        ],
                    },
                    {
                        name: "Venue Permits",
                        types: ["Other Venue Permits and Fees"],
                        entries: [
                        ],
                    },
                    {
                        name: "HOTAC",
                        types: ["PD HOTAC", "Other Manpower HOTAC", "Other HOTAC Fees"],
                        entries: [
                        ],
                    },
                    {
                        name: "Contingency",
                        types: ["Contingency Fund"],
                        entries: [
                        ],
                    },
                    {
                        name: "Others",
                        types: ["Others"],
                        entries: [
                        ],
                    },
                ],
            },
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
        
            units: ["PAX", "TEAM", "LOT", "ROOMS"],
        };
    },
    getters: {
       getTotalBudgetRequest(state, getters){
           var total = 0;
           state.budget_request.categories.forEach(category => {
                category.entries.forEach(entry => {
                   total +=  (entry.quantity *
                   entry.unit_price *
                   entry.no_of_days *
                   entry.no_of_venues);
                })
           });
        return total;
       },
       getParentName(state){
           return state.parent.name;
       },
       budget_request_form(state){
        var budget_request = state.budget_request;
        state.categories.forEach(category => {
            category.entries.forEach(entry => {
                budget_request.entries.push(entry);
            });
        });
        return budget_request;
       }
    },
    mutations: {
        addEntry(state, category) {
            var find_category = state.budget_request.categories.find(
                (module_category) => module_category == category
            );
            find_category.entries.push({
                type: null,
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
                var find_category = state.budget_request.categories.find(
                    (module_category) => module_category == category.category
                );
                console.log("the fuck is your entry index", category.entry_index);
                find_category.entries.splice(category.entry_index, 1);
        },
        setType(state, type){
            state.type = type;
        },
        setParent(state, parent){
            state.parent = parent;
            state.loading = false;
        },
        setStartDate(state, start_date){
            state.budget_request.start_date = start_date;
        },
        setEndDate(state, end_date){
            state.budget_request.end_date = end_date;
        },
        setBrableType(state, type){
            console.log("test me ", type);
            state.budget_request.brable_type = type;
        },
        setBrableId(state, id){
            console.log("test me too", id);
            state.budget_request.brable_id = id;
        }

    },
    actions: {
        loadParentRequirement({commit, state}, parent_id){
            if(state.type == 'Project'){
                console.log("hmm");
                axios.get("/api/project/"+parent_id).then(response => {
                    var project = response.data.data;
                    commit("setParent", project);
                    commit("setBrableType", "App\\Project");
                    commit("setBrableId", project.id);
                });                  
            }else if (state.type =='Account'){
                // axios.get("/api/account/"+parent_id).then(response => {
                //     var project = response.data.data;
                //     commit("setParent", project);
                // });      
            }
        }
    },
};
