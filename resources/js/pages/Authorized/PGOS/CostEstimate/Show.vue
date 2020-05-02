<template>
    <div>
        <div v-if="project != null">
         <create-cost-estimate v-if="cost_estimate==null" :steps="steps" :project='project' :cost_estimate="cost_estimate"></create-cost-estimate>
         <show-cost-estimate v-else></show-cost-estimate>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import showCostEstimate from "./Show/ShowCostEstimate";
import createCostEstimate from "./Show/createCostEstimate";
export default {
    data() {
        return {
            steps: this.$store.state.costEstimate.steps,
            project: null,
            cost_estimate: null,
        };
    },
    components: {
        "show-cost-estimate": showCostEstimate,
        "create-cost-estimate": createCostEstimate
    },
    computed:{
        mode(){
            return this.project.relationships.cost_estimate ? "Show" : "Create";
        }
    },
    methods: {
        loadProject() {
            var project_id = this.$route.params.id;
            axios.get("/api/project/" + project_id).then((response) => {
                this.project = response.data.data;
                this.cost_estimate = response.data.data.relationships.cost_estimate;
            });
        },
    },

    mounted() {
        this.loadProject();
    },
};
</script>
