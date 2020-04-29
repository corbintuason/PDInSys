<template>
	<div>
		<div class="text-center">
			<vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
		</div>
		<hr />
		<div class="component-sub-content mt-4 mb-3">
			<div class="text-center mt-4">
				<h5>
					<i>Government Details</i>
				</h5>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="sss">
						SSS No:
						<strong class="red">*</strong>
					</label>
					<b-input v-model="form.sss_number" id="sss"></b-input>
				</div>
				<div class="col-md-6 mb-3">
					<label for="tin">
						TIN No:
						<strong class="red">*</strong>
					</label>
					<b-input v-model="form.tin_number" id="tin"></b-input>
				</div>
				<div class="col-md-6">
					<label for="pagibig">
						PAGIBIG No:
						<strong class="red">*</strong>
					</label>
					<b-input v-model="form.pagibig_number" id="pagibig"></b-input>
				</div>
				<div class="col-md-6">
					<label for="philhealth">
						PHILHEALTH No:
						<strong class="red">*</strong>
					</label>
					<b-input v-model="form.philhealth_number" id="philhealth"></b-input>
				</div>
				<div class="col-md-12 mt-3">
					<label for="passport">PASSPORT No:</label>
					<b-input v-model="form.passport_number" id="passport"></b-input>
				</div>
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
			sss_number: "",
			tin_number: "",
			pagibig_number: "",
			philhealth_number: "",
			passport_number: ""
		}
	},
	components: {
		vueStep
	}
}
</script>

<style>
</style>