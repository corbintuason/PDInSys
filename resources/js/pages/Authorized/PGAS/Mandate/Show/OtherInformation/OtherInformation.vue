<template>
	<div>
		<hr />
		<div class="text-center mt-4">
			<h5>
				<i>Other Information</i>
			</h5>
		</div>
		<div class="component-sub-content mt-4 mb-3">
			<div class="row">
				<!-- Father's -->
				<div class="col-md-6 mb-3">
					<label for="father">Father's Name:</label>
					<b-input
						:disabled="mode=='Show'"
						v-model="mandate.father_details.father_name"
						id="father"
						type="text"
					></b-input>
				</div>
				<div class="col-md-6 mb-3">
					<label for="father">Occupation:</label>
					<b-input
						:disabled="mode=='Show'"
						v-model="mandate.father_details.father_occupation"
						id="father"
						type="text"
						placeholder="Father's Occupation"
					></b-input>
				</div>
				<!-- Mother's -->
				<div class="col-md-6 mb-3">
					<label for="mother">Mother's Name:</label>
					<b-input
						:disabled="mode=='Show'"
						v-model="mandate.mother_details.mother_name"
						id="mother"
						type="text"
					></b-input>
				</div>
				<div class="col-md-6 mb-3">
					<label for="mother">Occupation:</label>
					<b-input
						:disabled="mode=='Show'"
						v-model="mandate.mother_details.mother_occupation"
						id="mother"
						type="text"
						placeholder="Mother's Occupation"
					></b-input>
				</div>
				<!-- Spouse's -->
				<div class="col-md-6 mb-3">
					<label for="spouse">Spouse's Name:</label>
					<b-input
						:disabled="mode=='Show'"
						v-model="mandate.spouse_details.spouse_name"
						id="spouse"
						type="text"
					></b-input>
				</div>
				<div class="col-md-6 mb-3">
					<label for="spouse">Occupation:</label>
					<b-input
						:disabled="mode=='Show'"
						v-model="mandate.spouse_details.spouse_occupation"
						id="spouse"
						type="text"
						placeholder="Spouse's Occupation"
					></b-input>
				</div>
			</div>
			<div class="text-center mt-4">
				<h5>
					<i>In Case of Emergency</i>
				</h5>
			</div>
			<!-- contact person -->
			<div class="row" v-for="(value, value_index) in mandate.emergency_details" :key="value_index">
				<div class="col-md-6">
					<label for="contact-person">Contact Person:</label>
				</div>
				<div class="col-md-5">
					<label for="contact-number">Contact Number:</label>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-6 mb-3">
					<b-input
						:disabled="mode=='Show'"
						v-model="mandate.emergency_details[value_index].contact_person"
						id="contact-person"
						type="text"
					></b-input>
				</div>
				<div class="col-md-5 mb-3">
					<b-input
						:disabled="mode=='Show'"
						v-model="mandate.emergency_details[value_index].contact_number"
						id="contact-number"
						type="number"
						placeholder="09xx-xxx-xxx"
					></b-input>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {

		}
	},
	props:{
		mandate: Object,
		mode: String,
	}
}
</script>

<style>
</style>