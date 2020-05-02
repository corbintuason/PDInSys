<template>
    <div>
        <!-- Item Progress -->
        <item-progress class="mt-3" :steps="steps" :mode="mode"></item-progress>
        
        <!-- Cost Estiamtes -->
        <cost-estimate></cost-estimate>
    </div>
</template>

<script>
import costEstimate from "./Create/CostEstimate"
export default {
    data() {
        return {
            mode: "Create",
            cost_estimate: null,
            steps: this.$store.state.costEstimate.steps
        };
    },
    components:{
        "cost-estimate": costEstimate
    },
    methods:{

    }, 
    
    mounted(){

    }
};
</script>
