<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao">{{ name }}</h1>
        </template>
        <b-card-body>
            <b-tabs fill>
                <b-tab title="Project Details">
                    <project-details :mode="mode" :project="project"></project-details>
                </b-tab>
                <b-tab title="Project Core Team" :disabled="allowProjectCoreTeam"></b-tab>
            </b-tabs>
         
        </b-card-body>
        <template v-slot:footer>
            <show-project-buttons :project="project" :item_model="item_model" :front_steps="front_steps"></show-project-buttons>
        </template>

    </b-card>
</template>

<script>
import projectDetails from "./ShowProject/ProjectDetails"
import showProjectButtons from "./ShowProject/ShowProjectButtons"
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
    },
    components: {
        "show-project-buttons": showProjectButtons,
        "project-details": projectDetails
    },
    computed: {
 
        allowProjectCoreTeam(){
            return this.project.status!='Approved'
        }
    },
    methods: {

    },
    mounted() {},
};
</script>
