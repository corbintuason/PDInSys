<template>
    <div>
        <b-card>
            <template v-slot:header>
                <h1 class="component-title">{{ name }}</h1>
            </template>
            <b-card-body>
                <existing-cost-estimate-details :project="project" :endpoints="endpoints" :cost_estimate_details="project.relationships.cost_estimate.relationships.details"></existing-cost-estimate-details>
                <hr>
                <!-- <create-cost-estimate-details></create-cost-estimate-details> -->
            </b-card-body>
        </b-card>
        <!-- Existing Cost Estiamte Details -->

        <!-- Create Cost Estiamte Details -->
        <!-- If Project Does Not Have Cost Estimate -->
        <!-- <with-cost-estimate
            v-if="hasCostEstimate"
            :cost_estimate_name="cost_estimate_name"
            :endpoints="endpoints"
            :project="project"
            :steps="steps"
        ></with-cost-estimate> -->

        <!-- If Project has Cost Estimate -->
        <!-- <without-cost-estimate
            v-else
            :cost_estimate_name="cost_estimate_name"
        ></without-cost-estimate> -->
    </div>
</template>

<script>
import withCostEstimate from "./UnsignedCEs/WithCostEstimate";
import withoutCostEstimate from "./UnsignedCEs/WithoutCostEstimate";
import existingCostEstimateDetails from "./UnsignedCEs/ExistingCostEstimateDetails";
import createCostEstimateDetails from "./UnsignedCEs/CreateCostEstimateDetails";
export default {
    data() {
        return {
            endpoints: {
                api:
                    "/api/project/" + this.project.id + "/cost-estimate-detail",
                show_route: "cost_estimate_show",
            },
        };
    },
    props: {
        project: Object,
        steps: Array,
    },
    components: {
        "with-cost-estimate": withCostEstimate,
        "without-cost-estimate": withoutCostEstimate,
        "existing-cost-estimate-details": existingCostEstimateDetails,
        "create-cost-estimate-details": createCostEstimateDetails,
    },
    computed: {
        hasCostEstimate() {
            return this.project.relationships.cost_estimate;
        },
           ce_code() {
            return "CEPD-" + this.project.code;
        },
           name() {
            return this.ce_code + " " + this.project.name;
        },

        cost_estimate_name() {
            return "CEPD" + this.project.code + " " + this.project.name;
        },
    },
};
</script>
