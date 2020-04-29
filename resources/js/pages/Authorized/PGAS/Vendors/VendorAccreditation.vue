<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/vendors">List of Vendors</b-breadcrumb-item>
			<b-breadcrumb-item active>Create Vendor</b-breadcrumb-item>
		</b-breadcrumb>
		<b-card class="mt-4" v-if="vendor!=null">
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
			<b-card-text>
				<b-tabs v-model="tabIndex" content-class="mt-3" fill>
					<b-tab title="Vendor Details" active>
						<!-- Vendor Details -->
						<vendor-details :mode="mode" :vendor="vendor"></vendor-details>
					</b-tab>
					<b-tab title="Tax Details">
						<!-- Tax Details -->
						<tax-details :mode="mode" :vendor="vendor"></tax-details>
					</b-tab>
					<b-tab title="Bank Details">
						<!-- Bank Details -->
						<bank-details :mode="mode" :vendor="vendor"></bank-details>
					</b-tab>
					<b-tab title="Accreditation Attachments">
						<!-- Accreditation Attachments -->
						<accreditation-details :mode="mode" :vendor="vendor"></accreditation-details>
					</b-tab>
				</b-tabs>
			</b-card-text>
			<template v-slot:footer>
				<!-- For Approval Status -->
				<template v-if="vendor.status=='For Approval'">
					<b-button variant="outline-success" class="float-right">Approve Vendor Accreditation</b-button>
					<b-button variant="outline-danger" class="float-right">Reject Vendor</b-button>
				</template>
			</template>
		</b-card>
	</div>
</template>

<script>
import vendorDetails from "./Show/VendorDetails";
import bankDetails from "./Show/BankDetails";
import taxDetails from "./Show/TaxDetails";
import accreditationDetails from "./Show/AccreditationDetails";
export default {
  data() {
    return {};
  },
  mixins: [form],
  components: {
	"vendor-details": vendorDetails,
	"bank-details": bankDetails,
	"tax-details": taxDetails,
	"accreditation-details": accreditationDetails
  },
  props: {
    user: Object,
    vendor: Object,
    mode: String,
    user_role: String
  },
  methods: {
    approveVendor() {
      // activate sweet alert
      const swal_object = {
        title: "Approve Vendor",
        icon: "question",
        confirmButtonText: "Are you sure?",
        text: "Vendor's status will be updated to Approved"
      };

      const axios_form = {
        api_link: "/api/vendor/" + this.vendor.id,
        status: "Approved",
      };

      this.updateItem(swal_object, axios_form);
    },
    rejectVendor(){
       // activate sweet alert
      const swal_object = {
        title: "Reject Vendor",
        icon: "warning",
        confirmButtonText: "Reject",
        text: "Vendor's status will be updated to Rejected"
      };

      const axios_form = {
        api_link: "/api/vendor/" + this.vendor.id,
        status: "Rejected",
      };

      this.updateItem(swal_object, axios_form);
    }
  },
  mounted() {
  }
};
</script>
<style></style>
