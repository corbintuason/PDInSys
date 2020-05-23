<template>
    <div>
        <b-card class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">Project Based Info Sheet</h1>
            </template>

            <b-card-text>
                <b-tabs v-model="tabIndex" content-class="mt-3" fill>
                    <b-tab title="General Info" active>
                        <general-info :mandate="mandate"></general-info>
                    </b-tab>
                    <b-tab title="Government Details">
                        <government-details
                            :mandate="mandate"
                        ></government-details>
                    </b-tab>
                    <b-tab title="Education Attainment and Work Experience">
                        <education-work :mandate="mandate"></education-work>
                    </b-tab>
                    <b-tab title="Other Information">
                        <other-information
                            :mandate="mandate"
                        ></other-information>
                    </b-tab>
                </b-tabs>
            </b-card-text>
            <template v-slot:footer>
                <div class="row">
                    <div class="col-md-6">
                        <b-button-group class="mt-1">
                            <b-button @click="tabIndex--"
                                >Previous Tab</b-button
                            >
                            <b-button @click="tabIndex++">Next Tab</b-button>
                        </b-button-group>
                    </div>
                    <div class="col-md-6 text-right">
                        <b-button
                            :disabled="isDisabled"
                            variant="success"
                            class="float-right"
                            @click="createMandate"
                            >Create Mandate</b-button
                        >
                    </div>
                </div>
            </template>
        </b-card>
    </div>
</template>

<script>
import form from "../../../../../mixins/form";
import accountModule from "../../../../../store/modules/mandate";
import generalInfo from "./components/GeneralInfo";
import governmentDetails from "./components/GovernmentDetails";
import otherInformation from "./components/OtherInformation";
import educationWork from "./components/EducationWork";
import { mapGetters, mapState } from "vuex";

export default {
    props: {
        steps: Array,
        endpoints: Object,
    },
    mixins: [form],
    data() {
        return {
            name: "Create Mandate",
            user: this.$store.state.user,
            tabIndex: 0,
            mandate: {
                date: "",
                position: "",
                full_name: {
                    last_name: "",
                    first_name: "",
                    middle_name: "",
                },
                region: "",
                permanent_address: "",
                present_address: "",
                gender: "",
                civil_status: "",
                birthdate: "",
                age: "",
                mobile_number: "",
                telephone_number: "",
                religion: "",
                sss_number: "",
                tin_number: "",
                pagibig_number: "",
                philhealth_number: "",
                passport_number: "",
                tertiary_details: {
                    tertiary_name: "",
                    tertiary_date: "",
                },
                secondary_details: {
                    secondary_name: "",
                    secondary_date: "",
                },
                primary_details: {
                    primary_name: "",
                    primary_date: "",
                },
                work_details: [
                    {
                        work_position: "",
                        job_description: "",
                        start_date: "",
                        end_date: "",
                    },
                ],
                father_details: {
                    father_name: "",
                    father_occupation: "",
                },
                mother_details: {
                    mother_name: "",
                    mother_occupation: "",
                },
                spouse_details: {
                    spouse_name: "",
                    spouse_occupation: "",
                },
                emergency_details: [
                    {
                        contact_person: "",
                        contact_number: "",
                    },
                ],
            },
        };
    },
    components: {
        "general-info": generalInfo,
        "government-details": governmentDetails,
        "other-information": otherInformation,
        "education-work": educationWork,
    },
    computed: {
        ...mapState({
            steps(state) {
                console.log(state);
                return state["mandate-create"].steps;
            },
        }),
        isDisabled() {
            if (this.mandate.position == "" || this.mandate.full_name == "") {
                return true;
            }
            if (
                this.mandate.present_address == "" ||
                this.mandate.permanent_address == ""
            ) {
                return true;
            }
            if (
                this.mandate.mobile_number == "" ||
                this.mandate.telephone_number == ""
            ) {
                return true;
            }
            if (
                this.mandate.tin_number == "" ||
                this.mandate.sss_number == ""
            ) {
                return true;
            }
            if (
                this.mandate.pagibig_number == "" ||
                this.mandate.philhealth_number == ""
            ) {
                return true;
            }
        },
    },
    methods: {
        createMandate() {
            var swal_object = {
                title: "Create Mandate",
                icon: "question",
                confirmButtonText: "Create Mandate",
                text: "Please check the details provided.",
                item: this.mandate,
                endpoints: {
                    api: "/api/mandate",
                    show_route: "mandate_show",
                },
            };
            this.fireCreateSwal(swal_object);
        },
    },
    beforeCreate() {
        this.$store.registerModule("mandate-create", mandateModule);
        // this.registerStoreModule("account-create", accountModule);
    },
    mounted() {},
};
</script>

<style></style>
