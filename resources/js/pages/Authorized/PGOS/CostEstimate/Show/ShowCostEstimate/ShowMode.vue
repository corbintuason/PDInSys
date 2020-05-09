<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <a href="#" @click="downloadCostEstimate">
                    {{ cost_estimate.name }}
                </a>
                <div
                    class="cost-estimate-details mb-0"
                    v-for="(detail, detail_index) in cost_estimate.relationships
                        .details"
                    :key="detail_index"
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
                                :value="detail.ce_number"
                                readonly
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            label="Version"
                            disabled
                            label-class="font-weight-bold"
                            class="col-md-2"
                        >
                            <b-form-input
                                type="number"
                                v-model="detail.version"
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            label="Peza/AR Only"
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
                            disabled
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
                            disabled
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
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
        cost_estimate: Object,
    },
    methods: {
        downloadCostEstimate() {
            axios({
                url: "/api/download_cost_estimate/" + this.cost_estimate.id,
                method: "GET",
                responseType: "blob", // important
            }).then((response) => {
                const url = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute("download", "file");
                document.body.appendChild(link);
                link.click();
            });
        },
    },
    mounted() {
        console.log("the cost estimate", this.cost_estimate);
    },
};
</script>
