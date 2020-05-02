<template>
    <div>
        <!-- Item Progress -->
        <item-progress
            class="mt-3"
            :steps="steps"
            :item="cost_estimate"
            :mode="mode"
        ></item-progress>

        <cost-estimate
            :project="project"
            :cost_estimate="cost_estimate"
        ></cost-estimate>
    </div>
</template>

<script>
import itemProgress from "../../../../../components/authorized/public/ItemProgress";
import costEstimate from "./CreateCostEstimate/CostEstimate";
export default {
    data() {
        return {
            mode: "Create",
        };
    },
    props: {
        steps: Array,
        cost_estimate: Object,
        project: Object,
    },
    components: {
        "cost-estimate": costEstimate,
    },
};
</script>
