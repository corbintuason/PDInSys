<template>
    <div>
        <div class="text-center">
            <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
        </div>
        <hr />
        <div class="component-sub-content mt-4 mb-4">
            <div class="row">
                <!-- TIN Number -->
                <div class="col-md-6">
                    <label>
                        TIN Number:
                        <strong class="red">*</strong>
                    </label>
                    <b-input-group>
                        <b-input
                            v-model="vendor.tin_number"
                            placeholder="000-000-000-00000"
                            required
                        ></b-input>
                    </b-input-group>
                </div>

                <!-- VAT / NV / NR -->
                <div class="col-md-6">
                    <label>VAT / NV / NR</label>
                    <b-input-group>
                        <b-form-select v-model="vendor.type_vat" required>
                            <option disabled>Please select an option</option>
                            <option>VAT</option>
                            <option>Non-VAT</option>
                            <option>Not Registered</option>
                        </b-form-select>
                    </b-input-group>
                </div>
            </div>

            <div
                class="row mt-2"
                v-for="(value, value_index) in vendor.ewt_details"
                :key="value_index"
            >
                <!-- EWT Details -->
                <b-form-group
                    class="col-md-2"
                    label="EWT Code"
                    label-class="font-weight-bold"
                >
                    <b-form-select v-model="value.detail">
                        <b-form-select-option :value="null" disabled> -- Please select an EWT Code -- </b-form-select-option>
						<b-form-select-option v-for="(ewt, ewt_index) in ewts" :key="ewt_index" :value="ewt">{{ewt.name}}</b-form-select-option>
					</b-form-select>
                </b-form-group>
				<!-- EWT Description -->
                <b-form-group
                    class="col-md-7"
                    label="EWT Detail"
                    label-class="font-weight-bold"
                >
                    <b-input readonly v-if="value.detail==null"></b-input>
					<b-input readonly v-else :value="value.detail.description"></b-input>
                </b-form-group>

				<!-- EWT Description -->
                <b-form-group
                    class="col-md-1"
                    label="EWT Percent"
                    label-class="font-weight-bold"
                >
                    <b-input readonly v-if="value.detail==null"></b-input>
					<b-input readonly v-else :value="value.detail.percent"></b-input>
                </b-form-group>
                <div class="col-md-1">
                    <b-button
                        :disabled="value_index == 0"
                        @click="removeRow(vendor.ewt_details, value_index)"
                        variant="outline-danger"
                    >
                        <i class="fas fa-trash"></i>
                    </b-button>
                </div>
            </div>

            <div class="mt-4">
                <b-button
                    @click="addRow(vendor.ewt_details)"
                    variant="success"
                    block
                >
                    <i class="fas fa-plus"></i>
                    <strong>Add EWT</strong>
                </b-button>
            </div>
        </div>
    </div>
</template>

<script>
import vueStep from "vue-step";

export default {
    props: {
        vendor: Object,
    },
    data() {
        return {
            nowStep: 2,
            stepList: ["", "", "", ""],
            selected: null,
            tin_number: "",
            type_vat: "",
            ewts: this.$store.state.tax.ewt_details,
            selected_ewt: null,
            selected_description: null,
            selected_percent: null,
            ewt_details: [
                {
                    detail: null,
                    description: null,
                    percent: null,
                },
            ],
        };
    },
    computed: {},
    methods: {
        addRow(model) {
            model.push({
                ewt_detail: null,
                ewt_description: null,
                ewt_percent: null,
                dropdowns: {
                    ewt_descriptions: [],
                    ewt_percent: [],
                },
            });
        },

        removeRow(model, index) {
            model.splice(index, 1);
        },

        renderDescriptionPercent(event) {
            // Where Event is the object
            var ewt_detail = this.ewts.find((ewt) => ewt.name == event.name);
            // Set Form EWT Detail value
            value.ewt_percent = null;
            value.ewt_detail = ewt_detail.name;
            value.dropdowns.ewt_descriptions = ewt_detail.descriptions;
        },
    },
    watch: {
        selected_ewt() {
            (this.selected_description = null), (this.selected_percent = null);
        },
        selected_description() {
            this.ewt_details.ewt_detail = this.vendor.ewt_details[
                value_index
            ].ewt_detail.name;
            this.ewt_details.ewt_descripion = this.vendor.ewt_details[
                value_index
            ].ewt_description.name;
            this.ewt_details.ewt_percent = this.vendor.ewt_details[
                value_index
            ].ewt_percent.name;
        },
    },
    components: {
        vueStep,
    },
};
</script>

<style></style>
