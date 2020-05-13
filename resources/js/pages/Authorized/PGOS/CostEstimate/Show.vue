<template>
    <div>
        <div v-if="mode != null">
            <!-- Here you can upload the cost estimate  -->
            <cost-estimate-file :project="project"></cost-estimate-file>
            <!-- Here you can see the signed CEs -->
            <signed-ces :signed_ces="signed_ces" :steps="steps"></signed-ces>
            <!-- Here you can see unsigned CEs -->
            <unsigned-ces
                :unsigned_ces="unsigned_ces"
                :steps="steps"
            ></unsigned-ces>
            <!-- Here you can create CEs -->
            <create-ces
                :steps="steps"
                :new_cost_estimate_details="new_cost_estimate_details"
                :project="project"
                :endpoints="endpoints"
            ></create-ces>
         
        </div>
        <clip-loader v-else color="orange"></clip-loader>

    </div>
</template>

<script>
import costEstimateFile from "./Show/CostEstimateFile";
import signedCEs from "./Show/SignedCEs";
import unsignedCEs from "./Show/UnsignedCEs";
import createCEs from "./Show/CreateCEs";
export default {
    data() {
        return {
            mode: null,
            new_cost_estimate_details: [
                {
                    version: null,
                    vat: "VAT",
                    sub_fields: [
                        {
                            sub_total: 0,
                            asf_rate: null,
                        },
                    ],
                },
            ],
            steps: this.$store.state.costEstimate.steps,
            project: null,
            endpoints: null,
            signed_ces: [],
            unsigned_ces: [],
        };
    },
    components: {
        "signed-ces": signedCEs,
        "cost-estimate-file": costEstimateFile,
        "unsigned-ces": unsignedCEs,
        "create-ces": createCEs,
    },
    computed: {},
    methods: {
        loadProject() {
            var project_id = this.$route.params.id;
            axios.get("/api/project/" + project_id).then((response) => {
                this.project = response.data.data;
                this.getMode();
                this.loadEndpoints();
                this.loadDetails();
            });
        },
        loadEndpoints() {
            this.endpoints = {
                api: "/api/project/" + this.project.id + "/cost-estimate",
                show_route: "cost_estimate_show",
            };
        },
        getMode() {
            this.mode = this.project.relationships.cost_estimate
                ? "Show"
                : "Create";
        },

        loadDetails() {
            if (this.project.relationships.cost_estimate != null) {
                if (
                    this.project.relationships.cost_estimate.relationships
                        .details != null
                ) {
                    this.project.relationships.cost_estimate.relationships.details.forEach(
                        (detail) => {
                            detail.endpoints = {
                                api: "/api/cost_estimate_detail/" + detail.id,
                                show_route: "show_cost_estimate",
                            };
                            if (detail.status=='Signed') {
                                this.signed_ces.push(detail);
                            } else {
                                this.unsigned_ces.push(detail);
                            }
                        }
                    );
                }
            }
        },
    },

    mounted() {
        this.loadProject();
        Fire.$on("switch-mode", (mode) => {
            if (mode == "Show") {
                this.loadProject();
            }
            this.mode = mode;
        });
    },
};
</script>

<style lang="scss">
.cost-estimate-details {
    background: #e9ecef;
    border-radius: 5px;
    padding: 10px;
    margin: 15px;

    .grand-total {
        border: 1px solid green;
    }
}
</style>
