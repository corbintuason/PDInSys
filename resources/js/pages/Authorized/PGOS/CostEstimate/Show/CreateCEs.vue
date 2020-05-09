<template>
    <b-card>
        <template v-slot:header>
            <h1 class="component-title">Create CE Details</h1>
        </template>
        <b-card-body>
            <div class="row">
                <div class="col-md-12">
                    <div
                        class="cost-estimate-details mb-0"
                        style="
                            border-left: 10px solid gray;
                            border-right: 10px solid gray;
                        "
                        v-for="(detail,
                        detail_index) in new_cost_estimate_details"
                        :key="detail_index"
                    >
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <b-button
                                    variant="danger"
                                    v-if="detail_index != 0"
                                    :disabled="detail_index == 0"
                                    @click="removeRow(detail_index)"
                                >
                                    <i class="fas fa-times"></i>
                                </b-button>
                            </div>
                        </div>
                        <!-- CE Number Version, Peza / AR -->
                        <div class="row ml-1 mt-1 mb-3">
                            <b-form-group
                                label="CE Number"
                                label-class="font-weight-bold"
                                class="col-md-4"
                            >
                                <b-form-input
                                    type="text"
                                    :value="generateCENumber(detail_index)"
                                    readonly
                                ></b-form-input>
                            </b-form-group>
                            <b-form-group
                                label="Version"
                                label-class="font-weight-bold"
                                class="col-md-2"
                            >
                                <b-form-input
                                    type="number"
                                    v-model="detail['version']"
                                ></b-form-input>
                            </b-form-group>
                            <b-form-group
                                label="VAT"
                                class="col-md-4"
                                label-class="font-weight-bold"
                            >
                                <b-form-radio-group
                                    v-model="detail['vat']"
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
                                        type="number"
                                        v-model="detail['sub_total']"
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
                                        type="number"
                                        v-model="detail['asf_rate']"
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
                                        :value="
                                            getTotalProjectCost(
                                                detail['sub_total'],
                                                detail['asf_rate']
                                            )
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
                                            ><strong class="text-success"
                                                >%</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <b-form-input
                                        readonly
                                        :value="getVAT(detail['vat'])"
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
                                        :value="
                                            getGrandTotal(
                                                getTotalProjectCost(
                                                    detail['sub_total'],
                                                    detail['asf_rate']
                                                ),
                                                getVAT(detail['vat'])
                                            )
                                        "
                                    ></b-input>
                                </b-input-group>
                            </b-form-group>
                        </div>
                        <div class="row ml-1 mb-3"></div>
                    </div>
                    <b-button
                        @click="addRow"
                        variant="outline-success"
                        block
                        class="mt-0"
                        >Add Detail</b-button
                    >
                </div>
            </div>
        </b-card-body>

        {{ new_cost_estimate_details }}
        <template v-slot:footer>
            <b-button
                class="float-right"
                variant="outline-success"
                @click="createCostEstimate"
            >
                Create Cost Estimate
            </b-button>
        </template>
    </b-card>
</template>

<script>
import form from "../../../../../mixins/form";
export default {
    data() {
        return {
            user: this.$store.state.user,
            new_cost_estimate_details: [
                {
                    version: null,
                    sub_total: null,
                    asf_rate: null,
                    vat: "VAT",
                },
            ],
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
    mixins: [form],
    props: {
        project: Object,
        steps: Array,
        endpoints: Object,
    },
    computed: {
        colorEquivalent() {
            return (detail) => {
                if (detail.status == "For Review") {
                    return "green";
                }
            };
        },
        getTotalProjectCost() {
            return (sub_total, asf_rate) => {
                var asf_rate_percent = asf_rate / 100;
                var sub_percent = sub_total * asf_rate_percent;
                var total_project_cost =
                    Number(sub_total) + Number(sub_percent);
                return total_project_cost;
            };
        },
        getVAT() {
            return (VAT) => {
                console.log("vat", VAT)
                if (VAT == "VAT") {
                    return 12;
                } else {
                    return 0;
                }
            };
        },
        getGrandTotal() {
            return (total_project_cost, vat) => {
                if (vat == 0) {
                    return total_project_cost;
                } else {
                    var cost_tax = total_project_cost * (vat / 100);
                    return total_project_cost + cost_tax;
                }
            };
        },
    },
    methods: {
        createCostEstimate() {
            var swal_html = this.loadSwalContents(this.steps, this.user);
            const swal_object = {
                title: "Create Cost Estimate",
                html: swal_html,
                text: "Please check the details provided.",
                confirmButtonText: "Create Cost Estimate",
                item: this.new_cost_estimate_details,
                endpoints: this.endpoints,
            };
            this.fireUploadSwal(swal_object);
            // console.log("hello");
            // var swal_html = this.loadSwalContents(this.steps, this.user);
            // var upload_test = "<p>Tanginagn yan hahahaha</p>"
            // swal_html+=upload_test;
            // const swal_object = {
            //     title: "Create Cost Estimate",
            //     html: swal_html,
            //     text: "Please check the details provided.",
            //     confirmButtonText: "Create Cost Estimate",

            //     item: this.new_cost_estimate_details,
            //     endpoints: this.endpoints,
            // };
            // this.fireCreateSwal(swal_object);
        },
        addRow() {
            this.new_cost_estimate_details.push({
                version: null,
                sub_total: null,
                asf_rate: null,
                vat: "VAT",
            });
        },

        generateCENumber(detail_index) {
            var num = detail_index + 1;
            var cost_estimate = this.project.relationships.cost_estimate;
            if (cost_estimate != null) {
                var details = this.project.relationships.cost_estimate
                    .relationships.details;
                if (details != null) {
                    num += details.length;
                }
            }
            return "CEPD" + this.project.code + "." + num;
        },

        removeRow(index) {
            this.new_cost_estimate_details.splice(index, 1);
        },
    },
    mounted() {},
};
</script>
