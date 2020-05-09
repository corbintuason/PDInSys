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
                                                    ><strong
                                                        class="text-success"
                                                        >&#8369;</strong
                                                    ></b-input-group-text
                                                >
                                            </template>
                                            <b-form-input
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
                                                    ><strong
                                                        class="text-success"
                                                        >&#8369;</strong
                                                    ></b-input-group-text
                                                >
                                            </template>
                                            <b-form-input
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
                                                    ><strong
                                                        class="text-success"
                                                        >&#8369;</strong
                                                    ></b-input-group-text
                                                >
                                            </template>
                                            <b-form-input
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
                                                    ><strong
                                                        class="text-success"
                                                        >&#8369;</strong
                                                    ></b-input-group-text
                                                >
                                            </template>
                                            <b-form-input
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
                    >
                        <div
                            class="cost-estimate-details mb-0"
                            :style="{
                                'border-left':
                                    '10px solid ' + colorEquivalent(detail),
                                'border-right':
                                    '10px solid ' + colorEquivalent(detail),
                            }"
                        >
                            <!-- CE Detail Code -->
                            <div class="row">
                                <b-form-group
                                    label-cols-sm="4"
                                    label="CE Number"
                                    label-class="font-weight-bold"
                                    class="col-md-4"
                                >
                                    <b-form-input
                                        type="text"
                                        :value="detail.code"
                                        readonly
                                    ></b-form-input>
                                </b-form-group>
                            </div>

                            <!-- CE Detail Code -->
                            <div class="row">
                                <div class="col-md-4">
                                    <table class="table table-sm table-bordered">
                                        <thead></thead>
                                        <tbody>
                                            <tr class="table-primary">
                                                <th>SUB TOTAL COST</th>
                                                <td>{{detail.sub_total}}</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>
                                                    Agency Service Fee ({{detail.asf_rate}}%)
                                                </th>
                                                <td>{{detail.asf_sub_total}}</td>
                                            </tr>
                                            <tr class="table-danger">
                                                <th>
                                                    Total Project Cost (Vat
                                                    Excluded)
                                                </th>
                                                <td>{{detail.total_project_cost}}</td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>VAT ({{detail.tax}}%)</th>
                                                <td>{{detail.project_vat}}</td>
                                            </tr>
                                            <tr class="table-danger">
                                                <th>
                                                    Grand Total (Vat Included)
                                                </th>
                                                <td>{{detail.grand_total}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-sm table-bordered">

                                        <tbody>
                                            <tr>
                                                <th class="table-secondary"> Internal Budget </th>
                                                <td class="table-warning">
                                     
                                            <b-input-group size="sm">
                                                <template v-slot:prepend>
                                                    <b-input-group-text
                                                        ><strong
                                                            class="text-success"
                                                            >&#8369;</strong
                                                        ></b-input-group-text
                                                    >
                                                </template>
                                                <b-input
                                                    type="number"
                                                
                                                ></b-input>
                                            </b-input-group>
                                                </td>
                                            </tr>
                                            <tr class="table-secondary">
                                                <th>Internal Savings</th>
                                                <td> Some Savings </td>
                                            </tr>
                                            <tr class="table-danger">
                                                <th >Incentive</th>
                                                <td>Some Incentive</td>
                                            </tr>
                                            <tr class="table-secondary" >
                                                <th>Total Savings</th>
                                                <td>Some Savings</td>
                                            </tr>
                                            <tr  class="table-danger">
                                                <th>P&L</th>
                                                <td>Some P&L</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                           <div class="row">
                                        <div class="col-md-12">
                                            <show-process-buttons
                                                :mode="mode"
                                                :item="detail"
                                                :item_model="item_model"
                                                :steps="steps"
                                                :endpoints="detail.endpoints"
                                            ></show-process-buttons>
                                        </div>
                                    </div>
                        </div>
                   
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
export default {
    data() {
        return {
            hasCostEstimateDetails: false,
            mode: "Show",
            item_model: "Cost Estimate Detail",
                   legends: [{
                status: "For Review (Signed)",
                color: "red"
            }, {
                status: "For Approval (Signed)",
                color: "orange"
            }, {
                status: "For Clearance (Signed)",
                color: "yellow"
            }, {
                status: "Cleared (Signed)",
                color: "green"
            }]
        };
    },
    props: {
        project: Object,
        steps: Array,
        signed_ces: Array,
    },
    components: {
        "color-legend": colorLegend,
        showProcessButtons: showProcessButtons,
    },
    computed: {
        colorEquivalent() {
            return (detail) => {
             var legend = this.legends.find(legend => legend.status == detail.status)
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
