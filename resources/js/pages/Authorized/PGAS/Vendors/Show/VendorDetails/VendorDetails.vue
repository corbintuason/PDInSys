<template>
	<div>
		<div class="component-sub-content mt-4 mb-3">
			<div class="row">
				<!-- Vendor Name -->
				<div class="col-md-6">
					<div class="form-group">
						<label>Registered Vendor Name:</label>
						<b-input-group>
							<b-input readonly v-model="vendor.vendor_name" type="text"></b-input>
						</b-input-group>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Line of Business -->
					<div class="form-group">
						<label>Line of Business:</label>
						<b-input-group>
							<b-input readonly v-model="vendor.line_business"></b-input>
						</b-input-group>
					</div>
				</div>
			</div>

			<div class="row">
				<!-- Trade Name -->
				<div class="col-md-6">
					<div class="form-group">
						<label>Trade Name:</label>
						<b-input-group>
							<b-input readonly v-model="vendor.trade_name" type="text"></b-input>
						</b-input-group>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Contact Person -->
					<div class="form-group">
						<label>Contact Person:</label>
						<b-input-group>
							<b-input
								readonly
								v-model="vendor.contact_person.last_name"
								type="text"
								placeholder="Last Name"
							></b-input>
							<b-input
								readonly
								v-model="vendor.contact_person.first_name"
								type="text"
								placeholder="First Name"
							></b-input>
							<b-input
								readonly
								v-model="vendor.contact_person.middle_name"
								type="text"
								placeholder="Middle Name"
							></b-input>
						</b-input-group>
					</div>
				</div>
			</div>

			<div class="row">
				<!-- Registered Address -->
				<div class="col-md-6">
					<div class="form-group">
						<label>Registered Address:</label>
						<b-input-group>
							<b-input
								readonly
								v-model="vendor.registered_address.no_st_bldg"
								type="text"
								placeholder="No. Street. Bldg."
							></b-input>
							<b-input readonly v-model="vendor.registered_address.brgy" type="text" placeholder="Brgy."></b-input>
							<b-input
								readonly
								v-model="vendor.registered_address.city"
								type="text"
								placeholder="City/Municipality"
							></b-input>
							<b-input
								readonly
								v-model="vendor.registered_address.zip_code"
								type="text"
								placeholder="Zip code"
							></b-input>
						</b-input-group>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Contact Number -->
					<div class="form-group">
						<label>Contact Number:</label>
						<b-input-group>
							<b-input readonly v-model="vendor.contact_number" type="number" placeholder="09xx-xxxx-xxx"></b-input>
						</b-input-group>
					</div>
				</div>
			</div>

			<div class="row mb-4">
				<!-- Type of Business -->
				<div class="col-md-6">
					<div class="form-group">
						<label>Type of Business:</label>
						<b-input-group>
							<b-input readonly v-model="vendor.type_business"></b-input>
						</b-input-group>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Email Address -->
					<div class="form-group">
						<label>Email Address:</label>
						<b-input-group>
							<b-input readonly v-model="vendor.email_address" type="text" placeholder="email@email.com"></b-input>
						</b-input-group>
					</div>
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