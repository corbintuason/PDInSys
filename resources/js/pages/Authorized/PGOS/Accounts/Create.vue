<template>
  <div>
      <item-progress class="mt-3" :steps="steps" :mode="'Create'"></item-progress>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Create Account & Client </h1>
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
      </b-card-text>
             <template v-slot:footer>
                <b-button variant="outline-success" class="float-right" @click="createAccount">Create Account and Clients</b-button>
      </template>
    </b-card>
  </div>
</template>

<script>

import form from "../../../../mixins/form"
import accountInformation from "./Create/AccountInformation";
import clientsInformation from "./Create/ClientsInformation";

export default {
  data() {
    return {
           mode: "Create",
      steps: this.$store.state.project.steps,
      endpoints:{
        api: "/api/account",
        show_route: "account_show"
      },
      form: {
        registered_name: "",
        registered_address: {
          no_st_bldg: "",
          barangay: "",
          city: "",
          zip_code: "",
        },
        registered_tin: "",
        terms_of_payment: [""],
        payment_milestone: [""],
        company_tel_number: [""],
        company_email_address: [""],
        accreditation_status: [""],
        brands: [""],
        departments: [""],
        clients: [],
      }
    };
  },
  mixins:[form],
  components: {
    "account-information": accountInformation,
    "clients-information": clientsInformation
  },

  watch:{
    brands(){
      console.log("Something changed sa brands");
          this.form.clients.forEach(client => {
        client.brands = [];
      });
    },
    departments(){
      console.log("somethin changed sa departments");
          this.form.clients.forEach(client => {
        client.departments = [];
      });
    }
  },
  computed:{
    brands(){
      return this.form.brands;
    },
    departments(){
      return this.form.departments;
    }
  },
  methods:{
    resetClientsBrandsDepartments(){
  
    },
    createAccount() {
      var swal_object = {
          title: "Create Account",
          icon: "question",
          confirmButtonText: "Create Account",
          text: "Please check the details provided.",
          item: this.form,
          endpoints:{
            api: "/api/account",
            show_route: "account_show"
          }
      };
      this.fireCreateSwal(swal_object);
    }
  },
  mounted(){
  }
};
</script>