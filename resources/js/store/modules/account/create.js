import axios from "axios";
import swal from "sweetalert2";
import {app} from "../../../app"
export const createAccountModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Account",
            model: "App\\Account",
            mode: "Create",

            // BELOW ARE FIELDS UNIQUE TO THE MODULE
            item: {
                registered_name: "",
                registered_address: {
                  no_st_bldg: "",
                  barangay: "",
                  city: "",
                  zip_code: "",
                },
                registered_tin: "",
                terms_of_payment: [""],
                payment_milestone: [""],
                company_tel_number: [""],
                company_email_address: [""],
                accreditation_status: [""],
                brands: [""],
                departments: [""],
                clients: [],
            },
        };
    },
    getters: {
       steps(state, getters, rootState){
        return rootState.account.steps;
       },
    },
    mutations: {

    },
    actions: {
        createAccount({commit, state}){
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
