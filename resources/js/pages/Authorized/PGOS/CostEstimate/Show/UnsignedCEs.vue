<template>
    <div>
        <b-card>
            <template v-slot:header>
                <h1 class="component-title">Unsigned CEs</h1>
            </template>
            <b-card-body>
                <div v-if="unsigned_ces.length > 0">
           
                    <div
                        v-for="(detail, detail_index) in unsigned_ces"
                        :key="detail_index"
                    >
                        <div class="row">
                            <div class="col-md-12">
                                <div
                                    class="cost-estimate-details mb-0"
                                    :style="{
                                        'border-left':
                                            '10px solid ' +
                                            colorEquivalent(detail),
                                        'border-right':
                                            '10px solid ' +
                                            colorEquivalent(detail),
                                    }"
                                >
                                    <!-- CE Number Version, Peza / AR -->
                                    <div class="row ml-1 mt-1 mb-3">
                                        <b-form-group
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
                                        <b-form-group
                                            label="Version"
                                            label-class="font-weight-bold"
                                            class="col-md-2"
                                        >
                                            <b-form-input
                                                readonly
                                                type="number"
                                                v-model="detail.version"
                                            ></b-form-input>
                                        </b-form-group>
                                        <b-form-group
                                            label="VAT"
                                            class="col-md-4"
                                            label-class="font-weight-bold"
                                        >
                                            <b-form-radio-group
                                                disabled
                                                v-model="detail.peza_ar"
                                                :options="peza_ar_options"
                                            >
                                            </b-form-radio-group>
                                        </b-form-group>
                                    </div>
                                    <!-- Sub Total, ASF Rate, Total Project Cost -->
                                    <div class="row ml-1 mt-1 mb-3">
                                        <b-form-group
                                            label="Sub-Total"
                                            label-class="font-weight-bold"
                                            class="col-md-2"
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
                                                    readonly
                                                    type="number"
                                                    v-model="detail.sub_total"
                                                ></b-form-input>
                                            </b-input-group>
                                        </b-form-group>
                                        <b-form-group
                                            label="ASF Rate"
                                            label-class="font-weight-bold"
                                            class="col-md-2"
                                        >
                                            <b-input-group>
                                                <template v-slot:append>
                                                    <b-input-group-text
                                                        ><strong
                                                            class="text-success"
                                                            >%</strong
                                                        ></b-input-group-text
                                                    >
                                                </template>
                                                <b-input
                                                    readonly
                                                    type="number"
                                                    v-model="detail.asf_rate"
                                                ></b-input>
                                            </b-input-group>
                                        </b-form-group>
                                        <b-form-group
                                            label="Total Project Cost"
                                            label-class="font-weight-bold"
                                            class="col-md-2"
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
                                                <b-input
                                                    readonly
                                                    type="number"
                                                    :value="
                                                        detail.total_project_cost
                                                    "
                                                ></b-input>
                                            </b-input-group>
                                        </b-form-group>
                                        <b-form-group
                                            label="VAT"
                                            label-class="font-weight-bold"
                                            class="col-md-1"
                                        >
                                            <b-input-group>
                                                <template v-slot:append>
                                                    <b-input-group-text
                                                        ><strong
                                                            class="text-success"
                                                            >%</strong
                                                        ></b-input-group-text
                                                    >
                                                </template>
                                                <b-form-input
                                                    readonly
                                                    :value="detail.vat"
                                                ></b-form-input>
                                            </b-input-group>
                                        </b-form-group>
                                        <b-form-group
                                            label="Grand Total"
                                            label-class="font-weight-bold green"
                                            class="col-md-4"
                                        >
                                            <b-input-group>
                                                <template v-slot:prepend>
                                                    <b-input-group-text
                                                        class="grand-total"
                                                        ><strong
                                                            class="text-success"
                                                            >&#8369;</strong
                                                        ></b-input-group-text
                                                    >
                                                </template>
                                                <b-input
                                                    class="grand-total"
                                                    readonly
                                                    type="number"
                                                    :value="detail.grand_total"
                                                ></b-input>
                                            </b-input-group>
                                        </b-form-group>
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
                        </div>
                    </div>
                             <div class="row">
                        <div class="col-md-12">
                            <color-legend :legends="legends"></color-legend>
                        </div>
                    </div>
                </div>
                <b-alert show v-else variant="danger"> <strong>No Cost Estimate Details have been made yet.</strong></b-alert>
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
            peza_ar_options: [
                {
                    value: "VAT",
                    text: "VAT",
                },
                {
                    value: "peza",
                    text: "Peza",
                },
                {
                    value: "ar_only",
                    text: "AR Only",
                },
            ],
                   legends: [{
                status: "For Review",
                color: "red"
            }, {
                status: "For Approval",
                color: "orange"
            }, {
                status: "For Clearance",
                color: "yellow"
            }, {
                status: "For Signing",
                color: "blue"
            },{
                status: "Signed",
                color: "green"
            }]
        };
    },
    props: {
        project: Object,
        steps: Array,
        unsigned_ces: Array,
    },
    components: {
        "color-legend": colorLegend,
        showProcessButtons: showProcessButtons,
    },
    computed: {
        colorEquivalent() {
            return (detail) => {
                if (detail.status == "For Review") {
                    return "red";
                } else if (detail.status == "For Approval") {
                    return "orange";
                } else if (detail.status == "For Clearance") {
                    return "yellow";
                } else if (detail.status == "For Signing") {
                    return "blue";
                } else if (detail.status == "Signed") {
                    return "green";
                }
            };
        },
    },
    methods: {
    },
    mounted() {

},
};
</script>
