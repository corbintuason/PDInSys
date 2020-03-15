<template>
  <div>
    <b-card class = "mt-3">
       <template v-slot:header>
        <h1 class="component-title">Progress Bar</h1>
      </template>
      <b-card-text>
  <step-progress :steps="my_steps" current-step="0" icon-class="fa fa-check"></step-progress>
      </b-card-text>
    </b-card>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Create Account & Client</h1>
      </template>
      <b-card-text>
        <b-tabs content-class="mt-3" fill>
          <b-tab title="Account Information" active>
            <account-information :form="form"></account-information>
          </b-tab>
          <b-tab title="Clients Information">
            <clients-information :form="form"></clients-information>
          </b-tab>
        </b-tabs>
        <b-button variant="outline-success" class="float-right">Create Client</b-button>
      </b-card-text>
    </b-card>
  </div>
</template>

<script>
import accountInformation from "./Create/AccountInformation";
import clientsInformation from "./Create/ClientsInformation";

export default {
  data() {
    return {
      my_steps: ["Create", "Approve"],
      form: {
        registered_name: "",
        registered_address: "",
        registered_tin: "",
        terms_of_payment: "",
        payment_milestone: "",
        company_tel_number: "",
        company_email_address: "",
        clients: [],
        accreditation_status: [""],
        brands: []
      }
    };
  },

  components: {
    "account-information": accountInformation,
    "clients-information": clientsInformation
  }
};
</script>