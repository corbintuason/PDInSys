<template>
  <div>
    <div class="text-center">
      <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
    </div>
    <hr />
    <div class="component-sub-content mt-4 mb-4">
      <!-- EWT Details -->
      <div class="row mt-3">
        <div class="col-md-4">
          <label>Bank Name</label>
        </div>
        <div class="col-md-4">
          <label>Account Name</label>
        </div>
        <div class="col-md-3">
          <label>Account Number</label>
        </div>
      </div>

      <div class="row mt-2" v-for="(value, value_index) in form.bank_details" :key="value_index">
        <div class="col-md-3">
          <b-form-select v-model="form.bank_details[value_index].bank_name" required>
            <option disabled>Please select an option</option>
            <option>BDO</option>
            <option>BPI</option>
            <option>China Bank</option>
            <option>City Bank</option>
            <option>EastWest</option>
            <option>HSBC</option>
            <option>Landbank</option>
            <option>Metro Bank</option>
            <option>PNB</option>
            <option>RCBC</option>
            <option>Security Bank</option>
            <option>Union Bank</option>
          </b-form-select>
        </div>
        <div class="col-md-4">
          <b-input-group>
            <b-input v-model="form.bank_details[value_index].account_name" type="text"></b-input>
          </b-input-group>
        </div>
        <div class="col-md-4">
          <b-input-group>
            <b-input v-model="form.bank_details[value_index].account_number" type="text"></b-input>
          </b-input-group>
        </div>
        <div class="col-md-1">
          <b-button
            :disabled="value_index==0"
            @click="removeRow(form.bank_details, value_index)"
            variant="outline-danger"
          >
            <i class="fas fa-trash"></i>
          </b-button>
        </div>
      </div>

      <div class="mt-4">
        <b-button @click="addRow(form.bank_details)" variant="success" block>
          <i class="fas fa-plus"></i>
          <strong>Add Bank</strong>
        </b-button>
      </div>
    </div>
    <!-- <div class="row">
        <div v-for="(value, value_index) in form.bank_details" :key="value_index">

          <div class="col-md-3">
            <b-form-select v-model="form.bank_details.bank_name" required>
              <option disabled>Please select an option</option>
              <option>BDO</option>
              <option>BPI</option>
              <option>China Bank</option>
              <option>City Bank</option>
              <option>EastWest</option>
              <option>HSBC</option>
              <option>Landbank</option>
              <option>Metro Bank</option>
              <option>PNB</option>
              <option>RCBC</option>
              <option>Security Bank</option>
              <option>Union Bank</option>
            </b-form-select>
          </div>
          <div class="col-md-4">

          </div>
          <div class="col-md-4">

            <b-input-group>
              <b-input v-model="form.bank_details.account_number" type="text"></b-input>
            </b-input-group>
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
    </div>-->
  </div>
</template>

<script>
import vueStep from "vue-step";
import form from "../../../../../mixins/form";
export default {
	props: {
		form: Object
	},
	mixins:[form],
	data() {
		return {
			nowStep: 3,
			stepList: ["", "", "", ""],
			bank_details: [{
				bank_name: "",
				account_name: "",
				account_number: ""
			}]
		};
	},
	methods: {
		addRow(model) {
            model.push("");
        },

        removeRow(model, index) {
            model.splice(index, 1);
        },
	},
	components: {
		vueStep
	}
};
</script>

<style></style>
