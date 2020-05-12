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
                                class="col-md-3"
                                label-class="font-weight-bold"
                            >
                                <b-form-radio-group
                                    v-model="detail['vat']"
                                    :options="peza_ar_options"
                                >
                                </b-form-radio-group>
                            </b-form-group>
                            <b-form-group
                                label="VAT%"
                                label-class="font-weight-bold"
                                class="col-md-3"
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
                            
                        </div>
                        <!-- Sub Total, ASF Rate, Total Project Cost -->
                        <div class="row ml-1" v-for="(field, field_index) in detail.sub_fields" :key="field_index">
                            <b-form-group
                                label="Sub-Total"
                                label-class="font-weight-bold"
                                class="col-md-4"
                            >
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money class="form-control" v-model="field.sub_total"></money>
                            
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
                                        v-model="field.asf_rate"
                                    ></b-input>
                                </b-input-group>
                            </b-form-group>
                            <b-form-group
                                label="Project Cost"
                                label-class="font-weight-bold"
                                class="col-md-4"
                            >
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                    <money disabled class="form-control"    :value="
                                            getTotalProjectCost(
                                               field.sub_total,
                                                field.asf_rate
                                            )
                                        "></money>
                                </b-input-group>
                            </b-form-group>
                                <b-button-group class="col-md-2">
                                    <b-button style="height:50%; weight:50%; margin-top:30px" variant="outline-success" @click="addSubField(detail)">Add Sub Field</b-button>
                                    <b-button style="height:50%; weight:50%; margin-top:30px" variant="outline-danger" v-if="field_index > 0" @click="deleteSubField(detail, field_index)">Delete</b-button>
                                </b-button-group>
                        </div>
                        <div class="row ml-1 mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-2"></div>
                            <b-form-group
                                label="Grand Total"
                                label-class="font-weight-bold green"
                                class="col-md-6"
                            >
                                <b-input-group>
                                    <template v-slot:prepend>
                                        <b-input-group-text class="grand-total"
                                            ><strong class="text-success"
                                                >&#8369;</strong
                                            ></b-input-group-text
                                        >
                                    </template>
                                     <money class="form-control grand-total" disabled    :value="
                                            getGrandTotal(
                                                 detail
                                                ,
                                                getVAT(detail.vat))
                                        "></money>
                                </b-input-group>
                            </b-form-group>
                        </div>
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
        new_cost_estimate_details: Array,
        project: Object,
        steps: Array,
        endpoints: Object,
    },
    computed: {
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
            return (detail, vat) => {
                var grand_total = 0;
                detail.sub_fields.forEach(sub_field => {
                    grand_total += this.getTotalProjectCost(sub_field.sub_total, sub_field.asf_rate);
                });
                if (vat == 0) {
                    return grand_total;
                } else {
                    var cost_tax = grand_total * (vat / 100);
                    return grand_total + cost_tax;
                }
            };
        },
    },
    methods: {
        addSubField(detail){
            detail.sub_fields.push(      {
                        sub_total: 0,
                        asf_rate: null,
                        });
        },
        deleteSubField(detail, field_index){
            detail.sub_fields.splice(field_index, 1);

        },

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
        },
        addRow() {
            this.new_cost_estimate_details.push(        {
                    version: null,
                    vat: "VAT",
                    sub_fields:[
                        {
                        sub_total: 0,
                        asf_rate: null,
                        }
                    ],
              
                },);
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
