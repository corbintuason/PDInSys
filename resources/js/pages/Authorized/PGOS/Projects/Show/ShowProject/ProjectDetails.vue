<template>
    <div class="row">
        <div class="col-md-6">
            <!-- Project Name -->
            <b-form-group label="Project Name" label-class="font-weight-bold">
                <b-form-input type="text" v-model="project.name"></b-form-input>
            </b-form-group>

            <!-- Account Name -->
            <account-selector
                :project="project"
                :mode="mode"
            ></account-selector>

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

            <!-- Locations -->
            <locations :project="project" :mode="mode"></locations>

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

            <!-- For Project Bidding -->
            <b-form-group>
                <b-form-checkbox v-model="project.for_project_bidding" switch>
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
</template>

<script>
import accountSelector from "./ProjectDetails/AccountSelector"
import locations from "./ProjectDetails/Locations"
export default {
    data() {
        return {
            project_score_vals: {
                min: 1,
                max: 10,
            },
            accounts: null,
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
            available_departments: [
                "Accounts and Business Development",
                "Project Execution",
                "Creatives - Copy and Digital",
                "Creatives - Design and Multimedia",
            ],
        };
    },
    components:{
        "account-selector": accountSelector,
        "locations": locations
    },
    props: {
        project: Object,
        mode: String,
    },
    computed: {
        account() {
            return this.project.account;
        },
        bidding_convert() {
            return this.project.for_project_bidding ? "Yes" : "No";
        },
    },
};
</script>
