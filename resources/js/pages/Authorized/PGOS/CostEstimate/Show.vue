<template>
    <div>
        <div v-if="project != null && mode!=null">
         <signed-ces></signed-ces>
         <create-ces></create-ces>
         <!-- <create-cost-estimate v-if="mode=='Create'" :steps="steps" :project='project' :endpoints="endpoints"></create-cost-estimate>
         <show-cost-estimate v-else-if="mode=='Show'" :steps="steps" :project='project' :endpoints="endpoints"></show-cost-estimate> -->
        </div>
        <clip-loader v-else color="orange"></clip-loader>

        <!-- 
            May 3 2020 Revisions:
                - Progress bar header should be : Project Code -- {code}
                - Only show code when project is finished to assigning
                - show "project code {code}" when not finsihed assigning
                -CEPD (Remove dash in code)
                - change Peza/AR to Vat Registration
                    - VAT (with 12%)
                    - Peza (without 12)
                    - AR Only (without 12)
                - Reviewer 
                - Approver 
                - Clearer
                - Cost Estiamte Created -> CE Development

                CE Development:
                    - Add a progress bar for EACH detail
                    - Remove progress bar from entire cost estimate
                




         -->
    </div>
</template>

<script>
import showCostEstimate from "./Show/ShowCostEstimate";
import createCostEstimate from "./Show/CreateCostEstimate";
export default {
    data() {
        return {
            mode: null,
            steps: this.$store.state.costEstimate.steps,
            project: null,
            endpoints: null,
        };
    },
    components: {
        "show-cost-estimate": showCostEstimate,
        "create-cost-estimate": createCostEstimate
    },
    computed:{
    },
    methods: {
        loadProject() {
            var project_id = this.$route.params.id;
            axios.get("/api/project/" + project_id).then((response) => {
                this.project = response.data.data;
                        this.getMode();
                this.loadEndpoints();
            });
        },
        loadEndpoints(){
            this.endpoints = {
                api: '/api/project/'+this.project.id+'/cost-estimate',
                show_route: 'cost_estimate_show'
            }
        },
        getMode(){
            this.mode = this.project.relationships.cost_estimate ? "Show" : "Create";
        }
    },

    mounted() {
        this.loadProject();
             Fire.$on('switch-mode', mode => {
                if(mode == 'Show'){
                    this.loadProject();
                    }
                this.mode = mode;
      });
    },
};
</script>
