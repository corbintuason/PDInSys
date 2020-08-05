import axios from "axios";
import swal from "sweetalert2";
import { app } from "../../../app";
export const createProjectModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Project",
            model: "App\\Project",
            mode: "Create",

            // BELOW ARE FIELDS UNIQUE TO THE MODULE
            selected_account: null,
            selected_client: null,
            selected_department: null,
            selected_brand: null,
            
            item: {
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
                brand_id: null,
            },
        };
    },
    getters: {
        steps(state, getters, rootState) {
            return rootState.project.steps;
        },
        statuses(state, getters, rootState) {
            return rootState.project.statuses;
        },
        project_score_vals(state, getters, rootState) {
            return rootState.project.project_score_vals;
        },
        available_departments(state, getters, rootState) {
            return rootState.project.available_departments;
        },
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
        },
        createProject({ commit, state }) {
            console.log("budget request", state.item);
            swal.fire({
                title: "Create Account",
                icon: "question",
                text: "Are you sure you want to create this Account?",
                confirmButtonText: "Create Account",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .post("/api/account", state.item)
                            .then((response) => {
                                resolve(response.data);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to process item`
                                );
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    swal.fire({
                        title: result.value.success_text,
                        icon: "success",
                        onClose: () => {
                            app.$router.push({
                                name: "account_show",
                                params: { id: result.value.item_id },
                            });
                        },
                    });
                }
            });
        },
    },
};
