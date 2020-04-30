<template>
    <div>
        <!-- Item Progress -->
        <!-- <item-progress
            class="mt-3"
            :front_steps="front_steps"
            :db_steps="db_steps"
            :item="a"
            :contributors="contributors"
            :mode="mode"
            :remarks="remarks"
        ></item-progress> -->

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
            steps: null
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
