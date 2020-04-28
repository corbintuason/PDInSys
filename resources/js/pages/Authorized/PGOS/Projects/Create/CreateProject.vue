<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao">{{ name }}</h1>
        </template>
        <b-card-body>
            <div class="row">
                <div class="col-md-6">
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

                    <!-- Account Name -->
                    <account-selector :project="project"></account-selector>

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
                    <locations :project="project"></locations>

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
export default {
    data() {
        return {
            name: "Create Project",
            user: this.$store.state.user,
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
                {
                    text: "Accounts and Business Development",
                    value: {
                        name: "Accounts and Business Development Team",
                        main: "Main Account Manager",
                        deputy: "Deputy Account Manager"
                    }
                },
                {
                    text: "Project Execution",
                    value: {
                        name: "Project Execution Team",
                        main: "Main Project Manager",
                        deputy: "Deputy Project Writer"
                    },
                },
                {
                    text: "Creatives - Copy and Digital",
                    value:{
                        name: "Copy and Digital Team",
                        main: "Main Creative Writer",
                        deputy: "Deputy Creative Writer"
                    },
                },
                {
                    text: "Creatives - Design and Multimedia",
                    value:{
                        name: "Design and Multimedia Team",
                        main: "Main Graphic Artist",
                        deputy: "Deputy Graphic Artist"
                    },
                },
            ],
            project_score_vals: {
                min: 1,
                max: 10,
            },
            project: {
                name: null,
                project_status: null,
                account: null,
                start_date: null,
                end_date: null,
                locations: [""],
                score: 1,
                for_project_bidding: false,
            },
        };
    },
    props: {
        front_steps: Array,
    },
    components: {
        "account-selector": accountSelector,
        locations: locations,
    },
    computed: {
        account() {
            return this.project.account;
        },
        bidding_convert() {
            return this.project.for_project_bidding ? "Yes" : "No";
        },
    },
    methods: {
        createProject() {
            var contents = "";
            console.log(this.project);

            // // Load Contents first
            this.front_steps.forEach((step) => {
                if (step.name == "Create") {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        this.user.meta.full_name +
                        "</strong></span></div>";
                } else {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        "</strong></span></div>";
                }
            });
            var swal_html =
                '<span>Contribution List will be Updated</span><div class="list-group">' +
                contents +
                "</div> <span>Please check the details provided</span>";
            swal.fire({
                title: "Create Project",
                icon: "question",
                html: swal_html,
                text: "Please check the details provided.",
                confirmButtonText: "Create Project",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .post("/api/project", this.project)
                            .then((response) => {
                                resolve(response.data);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to create project`
                                );
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    swal.fire({
                        title: "Project Succesfully Created",
                        icon: "success",
                        timer: "2500",
                        onClose: () => {
                            this.$router.push({
                                name: "project_show",
                                params: { id: result.value.data.id },
                            });
                        },
                    });
                }
            });
        },
    },
    mounted() {},
};
</script>
