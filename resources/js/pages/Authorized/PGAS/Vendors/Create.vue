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
				<!-- For Approval Status -->
				<div class="row">
					<div class="col-md-6">
						<b-button-group class="mt-1">
							<b-button @click="tabIndex--">Previous Tab</b-button>
							<b-button @click="tabIndex++">Next Tab</b-button>
						</b-button-group>
					</div>
					<div class="col-md-6 text-right">
						<b-button
							:disabled="isDisabled"
							variant="success"
							class="float-right"
							@click="createVendor"
						>Create Vendor</b-button>
					</div>
				</div>
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
					<b-tab title="Accreditation Attachments">
						<!-- Accreditation Attachments -->
						<accreditation-details :form="form"></accreditation-details>
					</b-tab>
				</b-tabs>
			</b-card-text>
		</b-card>
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
			front_steps: this.$store.state.globals.statuses.vendor.front_steps,
			db_steps: this.$store.state.globals.statuses.vendor.db_steps,
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
					bank_address: [{
						bank_branch: "",
						bank_city: ""
					}],
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
		   var contents = "";
            console.log(this.mandate);

            // // Load Contents first
            this.front_steps.forEach((step) => {
                if (step.name == "Create") {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        this.user.meta.full_name +
                        "</strong></span></div>";
                } else {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        "</strong></span></div>";
                }
            });
            var swal_html =
                '<span>Contribution List will be Updated</span><div class="list-group">' +
                contents +
                "</div> <span>Please check the details provided</span>";
	 	 swal
		.fire({
		  title: "Create Vendor",
		  icon: "question",
		  html: swal_html,
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
