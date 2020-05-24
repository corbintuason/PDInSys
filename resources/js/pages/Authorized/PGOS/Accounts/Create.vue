<template>
  <div>
    <div v-if="namespace!=null">
      <item-progress class="mt-3" :namespace="namespace"></item-progress>
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
  <clip-loader v-else color="orange"></clip-loader>
  </div>
</template>

<script>

import form from "../../../../mixins/form"
import states from "../../../../mixins/states"
import { accountModule } from "../../../../store/modules/account";
import accountInformation from "./Create/AccountInformation";
import clientsInformation from "./Create/ClientsInformation";
import { mapGetters, mapState } from "vuex";

export default {
  data() {
    return {
      namespace: null,
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
  mixins:[form, states],
  components: {
    "account-information": accountInformation,
    "clients-information": clientsInformation
  },

  computed:{
    brands(){
      return this.form.brands;
    },
    departments(){
      return this.form.departments;
    },
         ...mapState({
             steps(state) {
               console.log(state);
                return state["account-create"].steps;
            },

        }),
  },
  methods:{
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
  beforeCreate(){
          return new Promise((resolve, reject) => {
            resolve(this.$store.registerModule("account-create", accountModule));
        }).then((response) => {
          this.$store.dispatch("account-create" + "/changeMode", "Create");
          this.namespace = "account-create";
        });
  },
    mounted() {
          // console.log("stores", this.$store);

    },
};
</script>

