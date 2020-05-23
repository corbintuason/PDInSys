import axios from "axios";
export const projectModule = {
    namespaced: true,
    state(){
        return{
            name: "Project",
            model: "App\\Project",
            mode: null,
            item: null,
            
            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,
            
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
                
            ]
        }
 
    },
    getters: {
        getActionName(state, getters){
            return getters.getCurrentStep.name + " " + state.name;
        },
        getCurrentStep(state) {
            var status = state.item.status;
            var current_step = state.steps.find((step) => {
                return step.database_equivalent.includes(status);
            });
            return current_step;
        },
        getNextStep(state, getters) {
            console.log(state.steps, "the steps (?)");
            var next_step_index = state.steps.findIndex(object =>  object.name == getters.getCurrentStep.name)+1;
            var next_step = state.steps.find((val, index) => index == next_step_index);
            return next_step;
        },
        getEndpoints(state){
            var endpoints = {
                api: "/api/project/"+state.item.id,
                show_route: "project_show"
            };

            return endpoints;
        },
        getClients(state){
            return state.item.clients;
        },
        getRemarks(state)
        {
            return state.item.remarks.sort((a, b) => (a.created_at < b.created_at) ? 1 : -1)
        }
    },
    mutations: {
        changeLoading(state, load){
            state.loading = load
        },
        storeItem(state, project){
            state.item = project;
        },
        changeMode(state, mode){
            console.log("changing status of this project", state.mode);
            state.mode = mode;
            console.log("did it change?", state.mode);
        },
        changeShowReturnModal(state, status){
            console.log("is something happening");
            state.show_return_modal = status;
            console.log(state.show_return_modal);
        },
        changeShowRejectModal(state, status){
            state.show_reject_modal = status;
        },
        changeShowRemarksModal(state, status){
            console.log("remarks modal", state.show_remarks_modal);
            state.show_remarks_modal = status;
            console.log("should change", state.show_remarks_modal);
        }
    },
    actions: {
        changeMode(context, mode) {
            context.commit("changeMode", mode);
            if(mode == 'Show'){
                context.dispatch('storeAccount', context.state.account.id);
            }
        },
        storeItem(context, id) {
            context.commit("changeLoading", true);
            return new Promise((resolve, reject) => {
                axios.get("/api/project/"+id).then(response => {
                    var project = response.data.data;
                    context.commit("storeItem", project);
                    context.commit("changeLoading", false);
                    context.commit("changeMode", "Show");
                    resolve(project);
                }).catch(e => {
                    reject(e);
                });
            });
        },

    },
};
