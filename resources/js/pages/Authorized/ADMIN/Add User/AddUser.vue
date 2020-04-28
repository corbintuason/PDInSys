<template>
    <div>
        <b-form @submit.stop.prevent="createUser">
            <b-card class="mt-3">
                <template v-slot:header>
                    <h1 class="component-title">Add User</h1>
                </template>
                <b-card-body>
                    <b-tabs content-class="mt-3" fill>
                        <b-tab title="User Details" active>
                            <user-details :new_user="new_user"></user-details>
                        </b-tab>
                        <b-tab title="Job Description">
                            <job-description
                                :new_user="new_user"
                            ></job-description>
                        </b-tab>
                        <b-tab title="Module Access">
                            <module-access
                                :new_user="new_user"
                                :module_access="new_user.module_access"
                            ></module-access>
                        </b-tab>
                    </b-tabs>
                </b-card-body>
                <template v-slot:footer>
                    <b-button
                        variant="outline-success"
                        type="submit"
                        class="float-right"
                        >Create User</b-button
                    >
                </template>
            </b-card>
        </b-form>
    </div>
</template>

<script>
import userDetails from "./Add User/UserDetails";
import jobDescription from "./Add User/JobDescription";
import moduleAccess from "./Add User/ModuleAccess";
import form from "../../../../mixins/form";

export default {
    data() {
        return {
            new_user: {
                last_name: "",
                first_name: "",
                middle_name: "",
                employment_date: null,
                birth_date: null,
                official_photo: null,
                pdem_email: "",
                pdem_gmail: "",
                contact_numbers: [""],
                positions:[],
                job_details: {
                    position: null,
                    job_level: null,
                },
                module_access: {
                    permissions: [],
                    roles: [],
                },
            },
        };
    },
    mixins: [form],
    components: {
        "module-access": moduleAccess,
        "user-details": userDetails,
        "job-description": jobDescription,
    },
    methods: {
        createUser() {
            this.createItem();
            swal.fire({
                title: "Create User",
                icon: "question",
                confirmButtonText: "Create User",
                text: "Please check the details provided.",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .post("/api/user", this.new_user)
                            .then((response) => {
                                const user = response.data;
                                resolve(user);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to create user`
                                );
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    //(result);
                    swal.fire({
                        title: "User Succesfully Created",
                        icon: "success",
                        timer: "2500",
                        text:
                            "The default password has been sent to the user's PDEM Email",
                        onClose: () => {
                            // this.$router.push({ name : "Dashboard"});
                        },
                    });
                }
            });
        },
    },
};
</script>
