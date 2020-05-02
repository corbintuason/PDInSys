<template>
	<div>
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

			<div class="row mt-2" v-for="(value, value_index) in vendor.bank_details" :key="value_index">
				<div class="col-md-3">
					<b-input readonly v-model="vendor.bank_details[value_index].bank_name"></b-input>
				</div>
				<div class="col-md-4">
					<b-input-group>
						<b-input
							readonly
							placeholder="Branch"
							v-model="vendor.bank_details[value_index].bank_address.bank_branch"
							type="text"
						></b-input>
						<b-input
							readonly
							placeholder="Brgy / City"
							v-model="vendor.bank_details[value_index].bank_address.bank_city"
							type="text"
						></b-input>
					</b-input-group>
				</div>
				<div class="col-md-2">
					<b-input-group>
						<b-input readonly v-model="vendor.bank_details[value_index].account_name" type="text"></b-input>
					</b-input-group>
				</div>
				<div class="col-md-2">
					<b-input-group>
						<b-input readonly v-model="vendor.bank_details[value_index].account_number" type="text"></b-input>
					</b-input-group>
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