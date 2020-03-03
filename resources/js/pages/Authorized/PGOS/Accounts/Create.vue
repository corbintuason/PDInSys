<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Create Account & Client</h1>
      </template>
      <b-card-text>
        <!-- Account Details Section -->
        <account-details :form="form"></account-details>
        <hr />
        <accreditation-status :form="form"></accreditation-status>
        <hr />
        <brand-department :form="form"></brand-department>
        <!-- <client-details :form="form"></client-details> -->
        <b-button variant="outline-success" class="float-right">Create Client </b-button>
      </b-card-text>
    </b-card>
  </div>
</template>

<script>
import accountDetails from "../../../../components/authorized/admin/accounts/create/AccountDetails";
import accreditationStatus from "../../../../components/authorized/admin/accounts/create/AccreditationStatus";
import BrandDepartment from "../../../../components/authorized/admin/accounts/create/BrandDepartment";
import clientDetails from "../../../../components/authorized/admin/accounts/create/ClientDetails";

export default {
  data() {
    return {
      form: {
        registered_name: "",
        registered_address: "",
        registered_tin: "",
        terms_of_payment: "",
        payment_milestone: "",
        company_tel_number: "",
        company_email_address: "",
        clients:[],
        accreditation_status: [""],
        brands: [
        ]
      }
    };
  },
  
  components: {
    "account-details": accountDetails,
    "accreditation-status": accreditationStatus,
    "client-details": clientDetails,
    "brand-department": BrandDepartment
  },
};
</script>