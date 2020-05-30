import axios from "axios";
export const projectCreateModule = {
    namespaced: true,
    state(){
        return{
            name: "Project",
            model: "App\\Project",
            mode: "Create",

                    
            selected_account: null,
            selected_client: null,
            selected_department: null,
            selected_brand: null,
            

            project: {
                name: null,
                project_status: null,
                account: null,
                start_date: null,
                end_date: null,
                locations: [""],
                score: 1,
                for_project_bidding: false,
                client_id: null,
                department_id: null,
                brand_id: null
            },
            
            loading: false,
    
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
  
    },
    mutations: {
       selectAccount(state, account){
           state.selected_account = account;
       },
       selectClient(state, client){
        state.selected_client = client;
    },
    selectDepartment(state, department){
        state.selected_department = department;
    },
    selectBrand(state, brand){
        console.log("see brand", state.selected_brand);
        console.log("what brand did i receive", brand);
        state.selected_brand = brand;
        console.log("changed?", state.selected_brand);
    }
    },
    actions: {
        selectClient(context, client){
            context.commit("selectClient", client);

        },
        selectAccount(context, account){
            context.commit("selectAccount", account[0]);
        },
        selectDepartment(context, department){
            context.commit("selectDepartment", department)
        },
        selectBrand(context, brand){
            context.commit("selectBrand", brand)
        },
        resetModal(context){
            context.commit("selectAccount", null);
            context.commit("selectClient", null);
            context.commit('selectDepartment', null);
            context.commit("selectBrand", null);
        }
    },
};
