<template>
	<div>
		<div class="text-center">
			<vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
		</div>
		<hr />
		<div class="component-sub-content mt-4 mb-3">
			<div class="row">
				<div class="col-md-6">
					<label for="date">Date:</label>
					<b-form-datepicker readonly :value="dateToday" v-model="mandate.date" id="date" locale="en"></b-form-datepicker>
				</div>
				<div class="col-md-6">
					<label for="position">
						Position Applying For:
						<strong class="red">*</strong>
					</label>
					<b-form-select id="position" v-model="mandate.position">
						<option disabled>Please select an option</option>
						<option>Ambassador</option>
						<option>Ambassadress</option>
					</b-form-select>
				</div>
			</div>
			<hr />
			<div class="text-center mt-4">
				<h5>
					<i>General Information</i>
				</h5>
			</div>
			<div class="row">
				<!-- Full Name -->
				<div class="col-md-6">
					<div class="form-group">
						<label>
							Full Name:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-input v-model="mandate.full_name.last_name" type="text" placeholder="Last Name"></b-input>
							<b-input v-model="mandate.full_name.first_name" type="text" placeholder="First Name"></b-input>
							<b-input v-model="mandate.full_name.middle_name" type="text" placeholder="Middle Name"></b-input>
						</b-input-group>
					</div>
				</div>
				<!-- Region -->
				<div class="col-md-6">
					<label for="region">Region:</label>
					<b-form-select v-model="mandate.region" id="region">
						<option disabled>Please select an option</option>
						<option>NCR</option>
						<option>Region IV</option>
					</b-form-select>
				</div>
				<!-- Permanent Address -->
				<div class="col-md-12 mb-3">
					<label for="permanent-address">
						Permanent Address:
						<strong class="red">*</strong>
					</label>
					<b-input v-model="mandate.permanent_address" id="permament-address" type="text"></b-input>
				</div>
				<!-- Present Address -->
				<div class="col-md-12 mb-3">
					<label for="present-address">
						Present Address:
						<strong class="red">*</strong>
					</label>
					<b-input v-model="mandate.present_address" id="present-address" type="text"></b-input>
				</div>
				<hr />
				<!-- Gender -->
				<div class="col-md-3">
					<div class="form-group">
						<label>Gender:</label>
						<b-form-select v-model="mandate.gender" id="gender">
							<option disabled>Please select an option</option>
							<option>Male</option>
							<option>Female</option>
						</b-form-select>
					</div>
				</div>
				<!-- Civil Status -->
				<div class="col-md-3">
					<label for="civil-status">Civil Status:</label>
					<b-form-select v-model="mandate.civil_status" id="civil-status">
						<option disabled>Please select an option</option>
						<option>Single</option>
						<option>Married</option>
						<option>Divorced</option>
						<option>Seperated</option>
						<option>Widowed</option>
					</b-form-select>
				</div>
				<!-- Birthdate -->
				<div class="col-md-3">
					<label for="birthdate">Birthdate:</label>
					<b-form-datepicker v-model="mandate.birthdate" id="birthdate" locale="en"></b-form-datepicker>
				</div>
				<!-- Age -->
				<div class="col-md-3">
					<label for="age">Age:</label>
					<b-input id="age" v-model="mandate.age"></b-input>
				</div>
				<!-- Mobile Number -->
				<div class="col-md-4">
					<label for="mobile-number">
						Mobile Number:
						<strong class="red">*</strong>
					</label>
					<b-input v-model="mandate.mobile_number" id="mobile-number"></b-input>
				</div>
				<!-- Telephone Number -->
				<div class="col-md-4">
					<label for="telephone-number">
						Telephone Number:
						<strong class="red">*</strong>
					</label>
					<b-input v-model="mandate.telephone_number" id="telephone-number"></b-input>
				</div>
				<!-- Religion -->
				<div class="col-md-4">
					<label for="religion">Religion:</label>
					<b-input v-model="mandate.religion" id="religion" type="text"></b-input>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import vueStep from "vue-step";
export default {
	props: {
		mandate: Object
	},
	data() {
		return {
            nowStep: 1,
			stepList: ["", "", "", ""],
			date: "",
			position: "",
			full_name: {
				last_name: "",
				first_name: "",
				middle_name: ""
			},
			region: "",
			permanent_address: "",
			present_address: "",
			gender: "",
			civil_status: "",
			birthdate: "",
			age: "",
			mobile_number: "",
			telephone_number: "",
			religion: "",
		}
	},
	computed: {
		dateToday() {
			this.mandate.date = new Date().toISOString().substr(0, 10);
			return true
		}
	},
    components: {
        vueStep
    }
}
</script>

<style>
</style>