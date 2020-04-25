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
				<div class="col-md-3">
					<label>Bank Address</label>
				</div>
				<div class="col-md-2">
					<label>Account Name</label>
				</div>
				<div class="col-md-3">
					<label>Account Number</label>
				</div>
			</div>

			<div class="row mt-2" v-for="(value, value_index) in form.bank_details" :key="value_index">
				<div class="col-md-3">
					<b-form-select v-model="form.bank_details[value_index].bank_name">
						<option disabled>Please select an option</option>
						<option>BDO (Banco de Oro Universal Bank)</option>
						<option>BPI (Bank of the Philippine Islands)</option>
						<option>BPI Family Savings Bank (BFSB)</option>
						<option>China Bank (China Banking Corporation)</option>
						<option>City Bank</option>
						<option>EastWest (East West Banking Corporation)</option>
						<option>HSBC (The Hongkong and Shanghai Bank)</option>
						<option>Landbank (Land Bank of the Philippines)</option>
						<option>Metro Bank (Metropolitan Bank and Trust Company)</option>
						<option>PNB (Philippine National Bank)</option>
						<option>RCBC (Rizal Commercial Banking Corporation)</option>
						<option>Security Bank</option>
						<option>UPB (Union Bank of the Philippines</option>
					</b-form-select>
				</div>
				<div class="col-md-4">
					<b-input-group>
						<b-input v-model="form.bank_details[value_index].bank_address" type="text"></b-input>
					</b-input-group>
				</div>
				<div class="col-md-2">
					<b-input-group>
						<b-input v-model="form.bank_details[value_index].account_name" type="text"></b-input>
					</b-input-group>
				</div>
				<div class="col-md-2">
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
				bank_address: "",
				account_name: "",
				account_number: ""
			}]
		};
	},
	methods: {
		addRow(model) {
            model.push({
        		bank_name: "",
				bank_address: "",
				account_name: "",
				account_number: ""
			});
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
