<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <color-legend></color-legend>
            </div>
        </div>
        <div
            v-for="(detail, detail_index) in cost_estimate_details"
            :key="detail_index"
        >
            <div class="row">
                <div class="col-md-12">
                    <div class="cost-estimate-details mb-0">
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
                                            ><strong class="text-success"
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
                                            ><strong class="text-success"
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
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <b-input
                                        readonly
                                        type="number"
                                        :value="detail.total_project_cost"
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
                                            ><strong class="text-success"
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
                                        <b-input-group-text class="grand-total"
                                            ><strong class="text-success"
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
                                    :endpoints="endpoints"
                                ></show-process-buttons>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import showProcessButtons from "../../../../../../components/authorized/public/ShowProcessButtons";
import colorLegend from "../components/ColorLegend"
export default {
    data() {
        return {
            mode: "Show",
            item_model: "Cost Estimate Detail",
            steps: this.$store.state.costEstimate.steps,
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
        };
    },
    components: {
        "show-process-buttons": showProcessButtons,
        "color-legend" : colorLegend
    },
    props: {
        cost_estimate_details: Array,
        endpoints: Object,
    },
};
</script>
