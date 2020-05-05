<template>
    <div>
        <b-card class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">
                    {{ce_code}}
        
                </h1>
            </template>
            <b-card-body>
                <create-cost-estimate v-if="cost_estimate==null" :ce_code="ce_code"></create-cost-estimate>
                <show-cost-estimate v-else></show-cost-estimate>
            </b-card-body>
        </b-card>
    </div>
</template>

<script>
import createCostEstimate from "./CostEstimate/CreateCostEstimate"
import showCostEstimate from "./CostEstimate/ShowCostEstimate"
export default {
    data() {
        return {
            new_cost_estimate: {
                file_name: null,
                details: {},
            },
        };
    },
    props: {
        project: Object,
        cost_estimate: Object,
    },
    computed:{
        ce_code(){
            return "CEPD" + this.project.code + " " + this.project.name
        }
    },
    components:{
        "create-cost-estimate": createCostEstimate,
        "show-cost-estimate": showCostEstimate
    },
    methods: {},
    mounted() {},
};
</script>
