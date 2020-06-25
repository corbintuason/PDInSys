<template>
    <div>
        <b-card>
            <template v-slot:header>
                <h1 class="component-title">Signed CEs</h1>
            </template>
            <b-card-body>
                <div v-if="signed_ces.length > 0"
                    >
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
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        :value="total_budget"
                                        disabled
                                    ></money>
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
                     
                                    <b-form-input :value="project_pl" disabled style="text-align:right"></b-form-input>
                                    <!-- <money
                                        class="form-control"
                                        style="text-align: right;"
                                        :value="project_pl"
                                        disabled
                                    ></money> -->
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
                                    label="Requested Budget"
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
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        :value="requested_budget"
                                        disabled
                                    ></money>
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
                                    <money
                                        class="form-control"
                                        style="text-align: right;"
                                        :value="remaining_budget"
                                        disabled
                                    ></money>
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
                                '10px solid ' + colorEquivalent(detail),
                            'border-right':
                                '10px solid ' + colorEquivalent(detail),
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
                    color: "gray"
                },
                {
                    status: "For Review",
                    color: "red",
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
                    color: "orange",
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
        requested_budget(){
            return this.project.requested_budget
        },
        remaining_budget(){
            return this.project.total_remaining_budget
        },
        actual_signed_ces(){
            return this.signed_ces.filter(ce => ce.signed_ce_detail!=null);
        },
        total_budget(){
            var sum = 0;
            this.actual_signed_ces.forEach(ce => {
                sum+= Number(ce.signed_ce_detail.internal_budget);
            });
            return sum;
        },
        project_pl(){
            var total_savings = 0;
            var sum_sub_total = 0
            this.signed_ces.forEach(ce => {
                var sub_total = 0;
                ce.sub_fields.forEach(field => {
                    console.log("field", field);
                    sum_sub_total += field.sub_total;
                    sub_total+= field.sub_total;
                    console.log("current sub total", sum_sub_total);
                });
                var initial_savings = sub_total - ce.signed_ce_detail.internal_budget;
                total_savings += initial_savings - ce.signed_ce_detail.incentive;
            });

            return Math.round((total_savings/sum_sub_total)*100)+"%";
        },
        colorEquivalent() {
            return (detail) => {
                if(detail.signed_ce_detail!=null){
   var legend = this.legends.find(
                    (legend) => legend.status == detail.signed_ce_detail.status
                );
                }
             
                else return "gray";
                return legend.color;
            };
        },
        hasCostEstimate() {
            console.log("????", this.project.cost_estimate);
            return this.project.cost_estimate;
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
