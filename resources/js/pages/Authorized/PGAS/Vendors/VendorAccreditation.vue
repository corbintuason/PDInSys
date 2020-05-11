<template>
	<div>
		<b-card class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">Vendor VID-{{vendor_code}} - {{vendor.status}}</h1>
			</template>
			<b-card-text>
				<b-tabs v-model="tabIndex" content-class="mt-3" fill>
					<b-tab title="Vendor Details" active>
						<vendor-details :mode="mode" :vendor="vendor"></vendor-details>
					</b-tab>
					<b-tab title="Tax Details">
						<tax-details :mode="mode" :vendor="vendor"></tax-details>
					</b-tab>
					<b-tab title="Bank Details">
						<bank-details :mode="mode" :vendor="vendor"></bank-details>
					</b-tab>
					<!-- <b-tab title="Accreditation Attachments">
						<accreditation-details :mode="mode" :vendor="vendor"></accreditation-details>
					</b-tab>-->
				</b-tabs>
			</b-card-text>
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
						<show-process-buttons
							:mode="mode"
							:item="vendor"
							:item_model="item_model"
							:steps="steps"
							:endpoints="endpoints"
						></show-process-buttons>
					</div>
				</div>
			</template>
		</b-card>
	</div>
</template>

<script>
import form from "../../../../mixins/form";
import vendorDetails from "./Show/VendorDetails";
import bankDetails from "./Show/BankDetails";
import taxDetails from "./Show/TaxDetails";
import accreditationDetails from "./Show/AccreditationDetails";
import showProcessButtons from "../../../../components/authorized/public/ShowProcessButtons";
export default {
  data() {
    return {
		 tabIndex: 0,
		 name: "Show Vendor",
		item_model: "Vendor",
		user: this.$store.state.user,
	};
  },
   props: {
    steps: Array,
	vendor: Object,
	vendor_code: String,
	mode: String,
	endpoints: Object
  },
  mixins: [form],
  components: {
	"vendor-details": vendorDetails,
	"bank-details": bankDetails,
	"tax-details": taxDetails,
	"accreditation-details": accreditationDetails,
	"show-process-buttons": showProcessButtons,
  },
//   methods: {
//     approveVendor() {
//       // activate sweet alert
//       const swal_object = {
//         title: "Approve Vendor",
//         icon: "question",
//         confirmButtonText: "Are you sure?",
//         text: "Vendor's status will be updated to Approved"
//       };

//       const axios_form = {
//         api_link: "/api/vendor/" + this.vendor.id,
//         status: "Approved",
//       };

//       this.updateItem(swal_object, axios_form);
//     },
//     rejectVendor(){
//        // activate sweet alert
//       const swal_object = {
//         title: "Reject Vendor",
//         icon: "warning",
//         confirmButtonText: "Reject",
//         text: "Vendor's status will be updated to Rejected"
//       };

//       const axios_form = {
//         api_link: "/api/vendor/" + this.vendor.id,
//         status: "Rejected",
//       };

//       this.updateItem(swal_object, axios_form);
// 	},
// 	returnProject() {
// 		this.$bvModal.show("return-item");
// 	},
//   },
  mounted() {
  }
};
</script>
<style></style>
