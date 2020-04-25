<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/vendors">List of Vendors</b-breadcrumb-item>
			<b-breadcrumb-item active>Create Vendor</b-breadcrumb-item>
		</b-breadcrumb>
		<b-card class="mt-4">
			<template v-slot:header>
				<h1 class="component-title">Progress Bar</h1>
			</template>
			<b-card-text>
				<step-progress :steps="my_steps" icon-class="fa fa-check"></step-progress>
			</b-card-text>
		</b-card>
		<b-card class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">Vendor Accreditation</h1>
			</template>
			<template v-slot:footer>
				<b-button
					:disabled="isDisabled"
					variant="success"
					class="float-right"
					@click="createVendor"
				>Create Vendor</b-button>
			</template>
			<b-card-text>
				<b-tabs v-model="tabIndex" content-class="mt-3" fill>
					<b-tab title="Vendor Details" active>
						<!-- Vendor Details -->
						<vendor-details :form="form"></vendor-details>
					</b-tab>
					<b-tab title="Tax Details">
						<!-- Tax Details -->
						<tax-details :form="form"></tax-details>
					</b-tab>
					<b-tab title="Bank Details">
						<!-- Bank Details -->
						<bank-details :form="form"></bank-details>
					</b-tab>
					<b-tab title="Accreditation Attachments" active>
						<!-- Accreditation Attachments -->
						<accreditation-details :form="form"></accreditation-details>
					</b-tab>
				</b-tabs>
			</b-card-text>
		</b-card>
		<div class="row">
			<div class="col-md-12 text-center">
				<b-button-group class="mt-1">
					<b-button variant="primary" @click="tabIndex--">Previous</b-button>
					<b-button variant="primary" @click="tabIndex++">Next</b-button>
				</b-button-group>
			</div>
		</div>
	</div>
</template>

<script>
import vendorDetails from "./Create/VendorDetails";
import bankDetails from "./Create/BankDetails";
import taxDetails from "./Create/TaxDetails";
import accreditationDetails from "./Create/AccreditationDetails";
export default {
	data() {
		return {
			user: this.$store.state.user,
			user_role: null,
			my_steps: ["Create", "Approve"],
			tabIndex: 0,
			form: {
				vendor_name: "",
				trade_name: "",
				registered_address: {
					no_st_bldg: "",
					barangay: "",
					city: "",
					zip_code: "",
				},
				type_business: "",
				line_business: "",
				contact_person: {
					last_name: "",
					first_name: "",
					middle_name: ""
				},
				contact_number: "",
				email_address: "",
				tin_number: "",
				type_vat: "",
				ewt_details: [{
					ewt_detail: null,
					ewt_description: null,
					ewt_percent: null,
					dropdowns:{
						ewt_descriptions:[],
						ewt_percent:[],
					}
				}],
				bank_details: [{
					bank_name: "",
					bank_address: "",
					account_name: "",
					account_number: ""
				}],
				other_attachments: [""],
				creator_id: this.$store.state.user.data.id
			},
		};
	},
	components: {
		"vendor-details": vendorDetails,
		"bank-details": bankDetails,
		"tax-details": taxDetails,
		"accreditation-details": accreditationDetails
	},
	computed:{
		isDisabled() {
			if (this.form.vendor_name == "" || this.form.trade_name == "") {
				return true;
			}
			if (this.form.registered_address == "" || this.form.contact_person == "") {
				return true;
			}
			if (this.form.type_business == "" || this.form.line_business == "") {
				return true;
			}
			if (this.form.contact_number == "" || this.form.email_address == "") {
				return true;
			}
			if (this.form.tin_number == "") {
				return true;
			}
		}
	},
	methods:{
	getUserRole(){
	  this.user_role = this.user.data.module_access[0]["modules"][0]["features"][1]["role"];
	},
	   createVendor() {
	  swal
		.fire({
		  title: "Create Vendor",
		  icon: "question",
		  confirmButtonText: "Create Vendor",
		  text: "Please check the details provided.",
		  showLoaderOnConfirm: true,
		  preConfirm: () => {
			this.$Progress.start();
			return new Promise((resolve, reject) => {
			  axios
				.post("/api/vendor", this.form)
				.then(response => {
				  const user = response.data;
				  resolve(user);
				})
				.catch(e => {
				  this.$Progress.fail();
				  swal.showValidationMessage(`Unable to create vendor`);
				  swal.hideLoading();
				  reject(e);
				});
			});
		  }
		})
		.then(result => {
		  if (result.value) {
			this.$Progress.finish();
			//(result);
			swal.fire({
			  title: "Vendor Succesfully Created",
			  icon: "success",
			  timer: "2500",
			  onClose: () => {
				this.$router.push({ name : "vendor_index"});
			  }
			});
		  }
		});
	}

  },
	mounted(){
		this.getUserRole();
	}
};
</script>

<style></style>
