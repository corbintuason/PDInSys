<template>
  <div>
    <b-card class="mt-5">
      <template v-slot:header>
        <h1 class="component-title">Progress Bar</h1>
      </template>
      <b-card-text>
        <step-progress :steps="my_steps" current-step="0" icon-class="fa fa-check"></step-progress>
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
            <vendor-details :form="form"></vendor-details>
          </b-tab>
          <b-tab title="Tax Details">
            <!-- Tax Details -->
            <tax-details></tax-details>
          </b-tab>
          <b-tab title="Bank Details">
            <!-- Bank Details -->
            <bank-details></bank-details>
          </b-tab>
          <b-tab title="Accreditation Attachments">
            <!-- Accreditation Attachments -->
            <accreditation-details></accreditation-details>
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
            form: {
                vendor_name: "",
                trade_name: "",
                registered_address: {
                    no_st_bldg: "",
                    barangay: "",
                    city: "",
                    zip_code: "",
                },
                type_business: null,
                line_business: null,
                contact_person: [],
                contact_number: [""],

                creator_id: this.$store.state.user.data.id
            },
            my_steps: ["Create", "Approve"],
            tabIndex: 1
        };
    },
    components: {
        "vendor-details": vendorDetails,
        "bank-details": bankDetails,
        "tax-details": taxDetails,
        "accreditation-details": accreditationDetails
    },
    mounted(){
        this.getUserRole();
    }
};
</script>

<style></style>
