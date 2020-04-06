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
          <label>TIN Number</label>
          <b-input-group>
            <b-input
              v-model="form.tin_number"
              type="number"
              placeholder="000-000-000-00000"
              required
            ></b-input>
          </b-input-group>
        </div>

        <!-- VAT / NV / NR -->
        <div class="col-md-6">
          <label>VAT / NV / NR</label>
          <b-input-group>
            <b-form-select v-model="form.type_vat" required>
              <option disabled>Please select an option</option>
              <option>VAT</option>
              <option>Non-VAT</option>
              <option>Not Registered</option>
            </b-form-select>
          </b-input-group>
        </div>
      </div>

      <!-- EWT Details -->
      <div class="row mt-3">
        <div class="col-md-2">
          <label>EWT Details</label>
        </div>
        <div class="col-md-7">
          <label>EWT Description</label>
        </div>
        <div class="col-md-3">
          <label>EWT %</label>
        </div>
      </div>

      <div class="row mt-2" v-for="(value, value_index) in form.ewt_details" :key="value_index">
        <div class="col-md-2">
          <b-form-select v-model="form.ewt_details[value_index].ewt_detail">
            <b-form-select-option :value="null" disabled>-- Please select a EWT --</b-form-select-option>
            <b-form-select-option
              v-for="(ewt_detail, ewt_index) in ewts"
              :key="ewt_index"
              :value="ewt_detail"
            >{{ewt_detail.name}}</b-form-select-option>
          </b-form-select>
        </div>
        <div class="col-md-7">
          <b-form-select v-model="form.ewt_details[value_index].ewt_description">
            <b-form-select-option :value="null" disabled>-- Please select a EWT Description --</b-form-select-option>
            <b-form-select-option
              v-for="(ewt_description, description_index) in form.ewt_details[value_index].ewt_detail.descriptions"
              :key="description_index"
              :value="ewt_description"
            >{{ewt_description.name}}</b-form-select-option>
          </b-form-select>
        </div>
        <div class="col-md-2">
          <b-form-select v-model="form.ewt_details[value_index].ewt_percent">
            <b-form-select-option :value="null" disabled>-- Please select a EWT % --</b-form-select-option>
            <b-form-select-option
              v-for="(ewt_percent, percent_index) in form.ewt_details[value_index].ewt_description.percents"
              :key="percent_index"
              :value="ewt_percent"
            >{{ewt_percent.name}}</b-form-select-option>
          </b-form-select>
        </div>
        <div class="col-md-1">
          <b-button
            :disabled="value_index==0"
            @click="removeRow(form.ewt_details, value_index)"
            variant="outline-danger"
          >
            <i class="fas fa-trash"></i>
          </b-button>
        </div>
      </div>

      <div class="mt-4">
        <b-button @click="addRow(form.ewt_details)" variant="success" block>
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
		form: Object
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
			ewt_details: [{
				ewt_detail: "",
				ewt_description: "",
				ewt_percent: ""
			}],
		};
	},
	methods: {
		addRow(model) {
            model.push({
				ewt_detail: "",
				ewt_description: "",
				ewt_percent: ""
			});
        },

        removeRow(model, index) {
            model.splice(index, 1);
        },
	},
	watch: {
		selected_ewt() {
			this.selected_description = null,
			this.selected_percent = null
		},
		selected_description() {
			this.ewt_details.ewt_detail = this.form.ewt_details[value_index].ewt_detail.name;
			this.ewt_details.ewt_descripion = this.form.ewt_details[value_index].ewt_description.name;
			this.ewt_details.ewt_percent = this.form.ewt_details[value_index].ewt_percent.name;
		}
	},
	components: {
		vueStep
	},
};
</script>

<style></style>
