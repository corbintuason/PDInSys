<template>
    <div>
        <!-- Item Progress -->
        <item-progress
            class="mt-3"
            :steps="steps"
            :item="project.cost_estimate"
            :mode="mode"
        ></item-progress>

        <cost-estimate
            :project="project"
            :cost_estimate="project.cost_estimate"
            :mode="mode"
            :steps="steps"
            :endpoints="endpoints"
        ></cost-estimate>

        <change-logs
            :logs="project.cost_estimate.actions"
        ></change-logs>
    </div>
</template>

<script>
import changeLogs from "../../../../../components/public/ChangeLogs"
import itemProgress from "../../../../../components/authorized/public/ItemProgress";
import costEstimate from "./ShowCostEstimate/CostEstimate";
export default {
    data() {
        return {
            mode: "Show",
        };
    },
    props: {
        steps: Array,
        project: Object,
        endpoints: Object,
    },
    components: {
        "cost-estimate": costEstimate,
        "change-logs": changeLogs
    },
};
</script>
