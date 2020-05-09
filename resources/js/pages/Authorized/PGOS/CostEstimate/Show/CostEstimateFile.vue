<template>
    <div>
        <!-- If Project Does Not Have Cost Estimate -->
        <with-cost-estimate
            v-if="hasCostEstimate"
            :cost_estimate_name="cost_estimate_name"
            :cost_estimate="project.relationships.cost_estimate"
        ></with-cost-estimate>

        <!-- If Project has Cost Estimate -->
        <without-cost-estimate
            v-else
            :cost_estimate_name="cost_estimate_name"
            :endpoints="endpoints"
        ></without-cost-estimate>
    </div>
</template>

<script>
import withCostEstimate from "./CostEstimateFile/WithCostEstimate";
import withoutCostEstimate from "./CostEstimateFile/WithoutCostEstimate";
export default {
    data() {
        return {
            endpoints: {
                api: "/api/project/" + this.project.id + "/cost-estimate",
                show_route: "cost_estimate_show",
            },
        };
    },
    props: {
        project: Object,
    },
    components: {
        "with-cost-estimate": withCostEstimate,
        "without-cost-estimate": withoutCostEstimate,
    },
    computed: {
        hasCostEstimate() {
            return this.project.relationships.cost_estimate;
        },

        cost_estimate_name() {
            return "CEPD" + this.project.code + " " + this.project.name;
        },
    },
};
</script>
