<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao"> {{ project.code }} {{project.status}} </h1>
        </template>
        <b-card-body>
            <b-tabs fill>
                <b-tab title="Project Details">
                    <project-details
                        :namespace="namespace"
                    ></project-details>
                </b-tab>
                <b-tab
                    :title="core_team_title"
                    :disabled="allowProjectCoreTeam"
                >
                    <project-core-team
                        id="core-team"
                        v-if="!allowProjectCoreTeam"
                        :namespace="namespace"
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
                :namespace="namespace"
            ></show-process-buttons>
        </template>
    </b-card>
</template>

<script>
import quickAccess from "./ShowProject/QuickAccess"
import projectDetails from "./ShowProject/ProjectDetails";
import projectCoreTeam from "./ShowProject/ProjectCoreTeam";
import showProcessButtons from "../../../../../components/authorized/public/ShowProcessButtons";
import {mapState} from "vuex"
export default {
    data() {
        return {

        };
    },
    props: {
        namespace: String,
    },
    components: {
        "show-process-buttons": showProcessButtons,
        "project-details": projectDetails,
        "project-core-team": projectCoreTeam,
        "quick-access": quickAccess
    },
    computed: {
        ...mapState({
            endpoints(state, getters){
                return getters[this.namespace +"/getEndpoints"];
            },
            steps(state){
                return state[this.namespace].steps
            },
            mode(state){
                return state[this.namespace].mode
            },
            project(state){
                return state[this.namespace].item;
            }
        }),
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
