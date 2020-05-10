<template>
    <div>
        <b-card>
            <template v-slot:header>
                <h1 class="component-title">Signed CEs</h1>
            </template>
            <b-card-body>
                <div v-if="signed_ces.length > 0">
                    <div id="upper_fields">
                        <!-- Total Budget -->
                        <div class="row mt-2">
                            <div
                                class="col offset-md-8 offset-lg-8 offset-sm-8"
                            >
                                <b-form-group
                                    label-cols-sm="4"
                                    label="Total Budget"
                                    label-class="font-weight-bold"
                                >
                                    <b-input-group>
                                        <template v-slot:prepend>
                                            <b-input-group-text 
                                                ><strong class="text-success"
                                                    >&#8369;</strong
                                                ></b-input-group-text
                                            >
                                        </template>
                                        <b-form-input readonly
                                        :value="total_budget"
                                            type="number"
                                        ></b-form-input>
                                    </b-input-group>
                                </b-form-group>
                            </div>
                        </div>
                        <!-- Project P&L -->
                        <div class="row mt-0">
                            <div
                                class="col offset-md-8 offset-lg-8 offset-sm-8"
                            >
                                <b-form-group
                                    label-cols-sm="4"
                                    label="Project PL"
                                    label-class="font-weight-bold"
                                >
                                    <b-input-group>
                                        <template v-slot:prepend>
                                            <b-input-group-text
                                                ><strong class="text-success"
                                                    >&#8369;</strong
                                                ></b-input-group-text
                                            >
                                        </template>
                                        <b-form-input
                                        readonly
                                        :value="project_pl"
                                            type="number"
                                        ></b-form-input>
                                    </b-input-group>
                                </b-form-group>
                            </div>
                        </div>
                        <!-- Disbursed Budget -->
                        <div class="row">
                            <div
                                class="col offset-md-8 offset-lg-8 offset-sm-8"
                            >
                                <b-form-group
                                    label-cols-sm="4"
                                    label="Disbursed Budget"
                                    label-class="font-weight-bold"
                                >
                                    <b-input-group>
                                        <template v-slot:prepend>
                                            <b-input-group-text
                                                ><strong class="text-success"
                                                    >&#8369;</strong
                                                ></b-input-group-text
                                            >
                                        </template>
                                        <b-form-input
                                        readonly
                                            type="number"
                                        ></b-form-input>
                                    </b-input-group>
                                </b-form-group>
                            </div>
                        </div>
                        <!-- Remaining Budget -->
                        <div class="row">
                            <div
                                class="col offset-md-8 offset-lg-8 offset-sm-8"
                            >
                                <b-form-group
                                    label-cols-sm="4"
                                    label="Remaining Budget"
                                    label-class="font-weight-bold"
                                >
                                    <b-input-group>
                                        <template v-slot:prepend>
                                            <b-input-group-text
                                                ><strong class="text-success"
                                                    >&#8369;</strong
                                                ></b-input-group-text
                                            >
                                        </template>
                                        <b-form-input
                                        readonly
                                            type="number"
                                        ></b-form-input>
                                    </b-input-group>
                                </b-form-group>
                            </div>
                        </div>
                    </div>

                    <div
                        v-for="(detail, detail_index) in signed_ces"
                        :key="detail_index"
                        class="cost-estimate-details mb-0"
                        :style="{
                            'border-left':
                                '10px solid ' + colorEquivalent(detail.relationships.signed_ce_detail),
                            'border-right':
                                '10px solid ' + colorEquivalent(detail.relationships.signed_ce_detail),
                        }"
                    >
                             <signed-ce :detail="detail" :steps="steps"></signed-ce>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <color-legend :legends="legends"></color-legend>
                        </div>
                    </div>
                </div>
                <b-alert show v-else variant="danger">
                    <strong
                        >No Cost Estimate Details have been signed yet.</strong
                    ></b-alert
                >
            </b-card-body>
        </b-card>
    </div>
</template>

<script>
import showProcessButtons from "../../../../../components/authorized/public/ShowProcessButtons";
import colorLegend from "../Show/components/ColorLegend";
import signedCE from "./SignedCEs/SignedCE"
export default {
    data() {
        return {
            steps: this.$store.state.signedCostEstimateDetails.steps,
            legends: [
                {
                    status: "For Creation",
                    color: "red"
                },
                {
                    status: "For Review",
                    color: "orange",
                },
                {
                    status: "For Approval",
                    color: "yellow",
                },
                {
                    status: "For Clearance",
                    color: "blue",
                },
                {
                    status: "Cleared",
                    color: "green",
                },
            ],
        };
    },
    props: {
        project: Object,
        signed_ces: Array,
    },
    components: {
        "color-legend": colorLegend,
        showProcessButtons: showProcessButtons,
        "signed-ce": signedCE
    },
    computed: {
        total_budget(){
            var sum = 0;
            this.signed_ces.forEach(ce => {
                sum+= Number(ce.relationships.signed_ce_detail.internal_budget);
            });
            return sum;
        },
        project_pl(){
            var all_savings = 0;
            var all_sub_total = 0
            this.signed_ces.forEach(ce => {
                all_savings+=Number(ce.relationships.signed_ce_detail.total_savings);
                all_sub_total+=Number(ce.sub_total);
            })
            console.log("all_savings", all_savings);
            console.log("sub_total", all_sub_total);
            return Number(all_savings/all_sub_total)*100+"%";
        },
        colorEquivalent() {
            return (detail) => {
                var legend = this.legends.find(
                    (legend) => legend.status == detail.status
                );
                return legend.color;
            };
        },
        hasCostEstimate() {
            console.log("????", this.project.relationships.cost_estimate);
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
    methods: {},
    mounted() {},
};
</script>
