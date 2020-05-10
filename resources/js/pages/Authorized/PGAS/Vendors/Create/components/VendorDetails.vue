<template>
	<div>
		<div class="text-center">
			<vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
		</div>
		<hr />
		<div class="component-sub-content mt-4 mb-3">
			<div class="row">
				<!-- Vendor Name -->
				<div class="col-md-6">
					<div class="form-group">
						<label>
							Registered Vendor Name:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-input v-model="vendor.vendor_name" type="text" required></b-input>
						</b-input-group>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Line of Business -->
					<div class="form-group">
						<label>
							Line of Business:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-form-select v-model="vendor.line_business" required>
								<option disabled>Please select an option</option>
								<option>Services</option>
								<option>Goods</option>
								<option>Both</option>
							</b-form-select>
						</b-input-group>
					</div>
				</div>
			</div>

			<div class="row">
				<!-- Trade Name -->
				<div class="col-md-6">
					<div class="form-group">
						<label>
							Trade Name:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-input v-model="vendor.trade_name" type="text" required></b-input>
						</b-input-group>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Contact Person -->
					<div class="form-group">
						<label>
							Contact Person:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-input
								v-model="vendor.contact_person.last_name"
								type="text"
								placeholder="Last Name"
								required
							></b-input>
							<b-input
								v-model="vendor.contact_person.first_name"
								type="text"
								placeholder="First Name"
								required
							></b-input>
							<b-input v-model="vendor.contact_person.middle_name" type="text" placeholder="Middle Name"></b-input>
						</b-input-group>
					</div>
				</div>
			</div>

			<div class="row">
				<!-- Registered Address -->
				<div class="col-md-6">
					<div class="form-group">
						<label>
							Registered Address:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-input
								v-model="vendor.registered_address.no_st_bldg"
								type="text"
								placeholder="No. Street. Bldg."
							></b-input>
							<b-input v-model="vendor.registered_address.brgy" type="text" placeholder="Brgy."></b-input>
							<b-input
								v-model="vendor.registered_address.city"
								type="text"
								placeholder="City/Municipality"
							></b-input>
							<b-input v-model="vendor.registered_address.zip_code" type="text" placeholder="Zip code"></b-input>
						</b-input-group>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Contact Number -->
					<div class="form-group">
						<label>
							Contact Number:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-input v-model="vendor.contact_number" type="number" placeholder="09xx-xxxx-xxx" required></b-input>
						</b-input-group>
					</div>
				</div>
			</div>

			<div class="row mb-4">
				<!-- Type of Business -->
				<div class="col-md-6">
					<div class="form-group">
						<label>
							Type of Business:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-form-select v-model="vendor.type_business" required>
								<option disabled>Please select an option</option>
								<option value="Sole Proprietorship">Sole Proprietorship</option>
								<option value="Corporation">Corporation</option>
							</b-form-select>
						</b-input-group>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Email Address -->
					<div class="form-group">
						<label>
							Email Address:
							<strong class="red">*</strong>
						</label>
						<b-input-group>
							<b-input v-model="vendor.email_address" type="text" placeholder="email@email.com" required></b-input>
						</b-input-group>
					</div>
				</div>
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
            nowStep: 1,
            stepList: ["", "", "", ""],
            vendor_name: "",
            trade_name: "",
            registered_address: {
                no_st_bldg: "",
                barangay: "",
                city: "",
                zip_code: "",
            },
            contact_person: {
                last_name: "",
                first_name: "",
                middle_name: ""
            },
            contact_number: "",
            email_address: "",
            line_business: "",
            type_business: "",
        };
    },
    components: {
        vueStep
    }
};
</script>

<style lang="scss" scoped>
</style>
