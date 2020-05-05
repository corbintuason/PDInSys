<template>
    <div class="row">
        <div class="col-md-12">
            <b-form-group
                label="Upload Cost Estimate File"
                label-class="font-weight-bold"
                class="col-md-6"
            >
                <b-form-file
                    v-model="new_cost_estimate.file_name"
                    class="mt-3"
                    plain
                    accept=".xlsx"
                ></b-form-file>
            </b-form-group>
            <div
                class="cost-estimate-details mb-0"
                v-for="(detail, detail_index) in new_cost_estimate.details"
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
<i class="fas fa-times"></i>                        </b-button>
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
                        label="Peza/AR Only"
                        class="col-md-4"
                        label-class="font-weight-bold"
                    >
                        <b-form-radio-group
                            v-model="detail['peza_ar']"
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
                                :value="getVAT(detail['peza_ar'])"
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
                                        getVAT(detail['peza_ar'])
                                    )
                                "
                            ></b-input>
                        </b-input-group>
                    </b-form-group>
                </div>
                <div class="row ml-1 mb-3">
        
                </div>
            </div>
            <b-button
                @click="addRow"
                variant="outline-success"
                block
                class="mt-0"
                >Add Detail</b-button
            >

            {{ new_cost_estimate }}
            <!-- Upload Cost Estimate File -->
            <!-- <b-form-group label="CE Number" label-class="font-weight-bold">
                <b-form-input disabled v-model="ce_number"> </b-form-input>
            </b-form-group> -->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            new_cost_estimate: {
                file_name: null,
                details: [],
            },
            peza_ar_options: [
                {
                    value: null,
                    text: "None",
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
    props: {
        ce_code: String,
    },
    computed: {
        ce_number() {
            return this.ce_code + ".1";
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
            return (peza_ar) => {
                if (peza_ar != null) {
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
        addRow() {
            this.new_cost_estimate.details.push({
                version: null,
                sub_total: null,
                asf_rate: null,
                peza_ar: null,
            });
        },

        generateCENumber(detail_index) {
            console.log("awii");
            var num = detail_index + 1;
            return this.ce_code + "." + num;
        },

        removeRow(index) {
            this.new_cost_estimate.details.splice(index, 1);
        },
    },
    mounted() {
        this.addRow();
    },
};
</script>

<style lang="scss">
.assign-budget {
    border: 2px solid #6c757d;
}
.cost-estimate-details {
    background: #e9ecef;
    border-left: 10px solid #3266a8;
    border-right: 10px solid #3266a8;
    border-radius: 5px;
    padding: 10px;
    margin: 15px;

    .grand-total {
        border: 1px solid green;
       
    }
}
</style>
