<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao">{{ project_code }}</h1>
        </template>
        <b-card-body>
            <b-tabs fill>
                <b-tab title="Project Details">
                    <project-details
                        :mode="mode"
                        :project="project"
                    ></project-details>
                </b-tab>
                <b-tab
                    :title="core_team_title"
                    :disabled="allowProjectCoreTeam"
                >
                    <project-core-team
                        id="core-team"
                        v-if="!allowProjectCoreTeam"
                        :project="project"
                        :core_team="core_team"
                    ></project-core-team>
                </b-tab>

            </b-tabs>
        </b-card-body>
        <template v-slot:footer>
            <show-project-buttons
                :mode="mode"
                :project="project"
                :item_model="item_model"
                :front_steps="front_steps"
                :contributors="contributors"
            ></show-project-buttons>
        </template>
    </b-card>
</template>

<script>
import projectDetails from "./ShowProject/ProjectDetails";
import projectCoreTeam from "./ShowProject/ProjectCoreTeam";
import showProjectButtons from "./ShowProject/ShowProjectButtons";
export default {
    data() {
        return {
            name: "Show Project",
            item_model: "Project",
            user: this.$store.state.user,
        };
    },
    props: {
        front_steps: Array,
        project: Object,
        mode: String,
        core_team: Object,
        project_code: String,
        contributors: Array,
    },
    components: {
        "show-project-buttons": showProjectButtons,
        "project-details": projectDetails,
        "project-core-team": projectCoreTeam,
    },
    computed: {
        core_team_title(){
            return this.allowProjectCoreTeam ? "Project Core Team (Available once project has been Approved)": "Project Core Team" ;
        },
        allowProjectCoreTeam() {
            return (
                this.project.status != "Approved" &&
                this.project.status != "Assigned"
            );
        },
    },
    methods: {},
    mounted() {},
};
</script>
