<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao">Project Code {{ project_code }} {{project.status}}</h1>
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
                    ></project-core-team>
                </b-tab>
                <b-tab title="Quick Access">
                    <quick-access :project="project">

                    </quick-access>
                </b-tab>

            </b-tabs>
        </b-card-body>
        <template v-slot:footer>
            <show-process-buttons
                :mode="mode"
                :item="project"
                :item_model="item_model"
                :steps="steps"
                :endpoints="endpoints"
            ></show-process-buttons>
        </template>
    </b-card>
</template>

<script>
import quickAccess from "./ShowProject/QuickAccess"
import projectDetails from "./ShowProject/ProjectDetails";
import projectCoreTeam from "./ShowProject/ProjectCoreTeam";
import showProcessButtons from "../../../../../components/authorized/public/ShowProcessButtons";
export default {
    data() {
        return {
            name: "Show Project",
            item_model: "Project",
            user: this.$store.state.user,
        };
    },
    props: {
        steps: Array,
        project: Object,
        mode: String,
        project_code: String,
        endpoints: Object
    },
    components: {
        "show-process-buttons": showProcessButtons,
        "project-details": projectDetails,
        "project-core-team": projectCoreTeam,
        "quick-access": quickAccess
    },
    computed: {
        core_team_title(){
            return this.allowProjectCoreTeam ? "Project Core Team (Available once project has been Approved)": "Project Core Team" ;
        },
        allowProjectCoreTeam() {
            return (this.project.status != "For Assigning" && this.project.status != "Assigned");
        },
    },
    methods: {},
    mounted() {},
};
</script>
