<template>
            <div class="row">
                <div class="col-md-12">
                    <b-form-group
                        v-if="mode == 'Edit'"
                        label="Upload Cost Estimate File"
                        label-class="font-weight-bold"
                        class="col-md-6"
                    >
                        <b-form-file
                            v-model="new_cost_estimate.cost_estimate"
                            placeholder="Choose a file or drop it here..."
                            drop-placeholder="Drop file here..."
                        ></b-form-file>
                    </b-form-group>
                    <a href="#"> {{ cost_estimate.name }} </a>

                    <div
                        class="cost-estimate-details mb-0"
                        v-for="(detail,
                        detail_index) in new_cost_estimate.details"
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
</template>