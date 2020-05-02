<template>
	<div>
		<div class="component-sub-content mt-4 mb-4">
			<div class="row">
				<!-- TIN Number -->
				<div class="col-md-6">
					<label>TIN Number:</label>
					<b-input-group>
						<b-input readonly v-model="vendor.tin_number"></b-input>
					</b-input-group>
				</div>

				<!-- VAT / NV / NR -->
				<div class="col-md-6">
					<label>VAT / NV / NR</label>
					<b-input-group>
						<b-input readonly v-model="vendor.type_vat"></b-input>
					</b-input-group>
				</div>
			</div>

			<!-- EWT Details -->
			<div class="row mt-3">
				<div class="col-md-2">
					<label>EWT Code</label>
				</div>
				<div class="col-md-7">
					<label>EWT Description</label>
				</div>
				<div class="col-md-3">
					<label>EWT %</label>
				</div>
			</div>

			<div class="row mt-2" v-for="(value, value_index) in vendor.ewt_details" :key="value_index">
				<!-- EWT Details -->
				<div class="col-md-2">
					<b-input readonly v-model="vendor.ewt_details[value_index].ewt_detail"></b-input>
				</div>
				<div class="col-md-7">
					<b-input readonly v-model="vendor.ewt_details[value_index].ewt_description"></b-input>
				</div>

				<div class="col-md-2">
					<b-input readonly v-model="vendor.ewt_details[value_index].ewt_percent"></b-input>
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
		vendor: Object,
		mode: String,
	}
}
</script>

<style>
</style>