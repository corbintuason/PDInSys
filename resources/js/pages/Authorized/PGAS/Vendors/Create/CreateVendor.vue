<template>
	<div>
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
						<vendor-details :vendor="vendor"></vendor-details>
					</b-tab>
					<b-tab title="Tax Details">
						<!-- Tax Details -->
						<tax-details :vendor="vendor"></tax-details>
					</b-tab>
					<b-tab title="Bank Details">
						<!-- Bank Details -->
						<bank-details :vendor="vendor"></bank-details>
					</b-tab>
					<b-tab title="Accreditation Attachments">
						<!-- Accreditation Attachments -->
						<accreditation-details :vendor="vendor"></accreditation-details>
					</b-tab>
				</b-tabs>
			</b-card-text>
		</b-card>
	</div>
</template>

<script>
import vendorDetails from "./components/VendorDetails";
import bankDetails from "./components/BankDetails";
import taxDetails from "./components/TaxDetails";
import accreditationDetails from "./components/AccreditationDetails";
import form from "../../../../../mixins/form";
export default {
    props: {
        steps: Array,
        endpoints: Object,
	},
	mixins: [form],
	data() {
		return {
            name: "Create Vendor",
			user: this.$store.state.user,
			tabIndex: 0,
			vendor: {
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
        get_status(){
            if(this.$store.getters.hasAbility("approve-all-vendors")){
                return "For Approval";
            }
        },
		isDisabled() {
			if (this.vendor.vendor_name == "" || this.vendor.trade_name == "") {
				return true;
			}
			if (this.vendor.registered_address == "" || this.vendor.contact_person == "") {
				return true;
			}
			if (this.vendor.type_business == "" || this.vendor.line_business == "") {
				return true;
			}
			if (this.vendor.contact_number == "" || this.vendor.email_address == "") {
				return true;
			}
			if (this.vendor.tin_number == "") {
				return true;
			}
		}
	},
    methods:{
	   createVendor() {
            this.vendor.status = this.get_status;
            var swal_html = this.loadSwalContents(this.steps, this.user);
            const swal_object = ({
                title: "Create Vendor",
                html: swal_html,
                text: "Please check the details provided.",
                confirmButtonText: "Create Vendor",
                item: this.vendor,
				endpoints: this.endpoints,
				
            });
            this.fireCreateSwal(swal_object);
        },
  	},
	// mounted(){
	// 	this.getUserRole();
	// }
};
</script>

<style></style>
