<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao">{{ name }}</h1>
        </template>
        <b-card-body>
            <div class="row">
                <div class="col-md-6">
                    <!-- Status -->
                    <b-form-group
                        label="Project Status"
                        label-class="font-weight-bold"
                        class="mt-3"
                    >
                        <b-form-select v-model="project.project_status">
                            <b-select-option :value="null"
                                >-- Please select a status --</b-select-option
                            >
                            <b-select-option
                                v-for="(status, status_index) in statuses"
                                :key="status_index"
                                :value="status"
                                >{{ status }}</b-select-option
                            >
                        </b-form-select>
                    </b-form-group>

                    <!-- Project Name -->
                    <b-form-group
                        label="Project Name"
                        label-class="font-weight-bold"
                    >
                        <b-form-input
                            type="text"
                            v-model="project.name"
                        ></b-form-input>
                    </b-form-group>

                    <!-- Start Date -->
                    <b-form-group
                        label="Start Date"
                        label-class="font-weight-bold"
                        class="mt-3"
                    >
                        <b-form-input
                            type="date"
                            v-model="project.start_date"
                        ></b-form-input>
                    </b-form-group>
                    <!-- End Date -->

                    <b-form-group
                        label="End Date"
                        label-class="font-weight-bold"
                        class="mt-3"
                    >
                        <b-form-input
                            type="date"
                            v-model="project.end_date"
                        ></b-form-input>
                    </b-form-group>

                    <!-- Account Name -->
                    <account-selector></account-selector>
                </div>
                <div class="col-md-6">
                    <!-- Project Score -->
                    <b-form-group
                        label="Project Score"
                        label-class="font-weight-bold"
                        class="mt-3"
                    >
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-form-input
                                    type="number"
                                    v-model="project.score"
                                ></b-form-input>
                            </template>
                            <b-form-input
                                type="range"
                                v-model="project.score"
                                :min="project_score_vals.min"
                                :max="project_score_vals.max"
                            ></b-form-input>
                        </b-input-group>
                    </b-form-group>
                    <!-- Locations -->
                    <locations :project="project"></locations>

                    <!-- For Project Bidding -->
                    <b-form-group class="mt-2">
                        <b-form-checkbox
                            v-model="project.for_project_bidding"
                            switch
                        >
                            For Project Bidding?
                            <template>
                                <strong
                                    :class="{
                                        green: project.for_project_bidding,
                                        red: !project.for_project_bidding,
                                    }"
                                    >{{ bidding_convert }}</strong
                                >
                            </template>
                        </b-form-checkbox>
                    </b-form-group>

                    <!-- Departments Needed -->
                    <b-form-group
                        label="Departments Needed"
                        label-class="font-weight-bold"
                        class="mt-3"
                    >
                        <b-form-checkbox-group
                            v-model="project.departments_needed"
                            :options="available_departments"
                            stacked
                        ></b-form-checkbox-group>
                    </b-form-group>
                </div>
                {{ project }}
            </div>
        </b-card-body>
        <template v-slot:footer>
            <b-button
                class="float-right"
                variant="outline-success"
                @click="createProject"
                >Create Project</b-button
            >
        </template>
    </b-card>
</template>

<script>
import accountSelector from "./CreateProject/AccountSelector";
import locations from "./CreateProject/Locations";
import form from "../../../../../mixins/form";
import {mapState} from "vuex";
export default {
    data() {
        return {
            name: "Create Project",
            user: this.$store.state.user,
            accounts: null,
        };
    },
    props: {
    },
    mixins: [form],
    components: {
        "account-selector": accountSelector,
        locations: locations,
    },
    computed: {
        ...mapState("create-project",{
            project(state){
                return state.item
            },
            statuses(state, getters){
                return getters.statuses;
            },
            project_score_vals(state, getters){
                return getters.project_score_vals
            },
            available_departments(state, getters){
                return getters.available_departments
            }


        }),
        get_status() {
            if (this.$store.getters.hasAbility("review-all-projects")) {
                return "For Approval";
            } else if (this.$store.getters.hasAbility("approve-all-projects")) {
                return "For Assigning";
            } else {
                return "For Review";
            }
        },
        account() {
            return this.project.account;
        },
        bidding_convert() {
            return this.project.for_project_bidding ? "Yes" : "No";
        },
    },
    methods: {
        createProject() {
            var swal_object = {
                title: "Create Project",
                icon: "question",
                confirmButtonText: "Create Project",
                text: "Please check the details provided.",
                item: this.project,
                endpoints: {
                    api: "/api/project",
                    show_route: "project_show",
                },
            };
            this.fireCreateSwal(swal_object);
        },
    },
    mounted() {},
};
</script>
