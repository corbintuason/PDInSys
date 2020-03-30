<template>
  <div>
    <b-card class = "mt-3">
       <template v-slot:header>
        <h1 class="component-title">Progress Bar</h1>
      </template>
      <b-card-text>
  <step-progress :steps="my_steps" :current-step="0" icon-class="fa fa-check"></step-progress>
  <br>
  {{form}}
      </b-card-text>
    </b-card>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Create Account & Client <strong class="orange float-right">{{user_role}}</strong></h1>
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
import accountInformation from "./Create/AccountInformation";
import clientsInformation from "./Create/ClientsInformation";

export default {
  data() {
    return {
      user: this.$store.state.user,
      user_role: null,
      my_steps: ["Create", "Approve"],
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

        creator_id: this.$store.state.user.data.id
      }
    };
  },

  components: {
    "account-information": accountInformation,
    "clients-information": clientsInformation
  },
  methods:{
    getUserRole(){
      console.log('start')
      this.user_role = this.user.data.module_access[0]["modules"][0]["features"][1]["role"];
    },
       createAccount() {
         console.log("rak");
      swal
        .fire({
          title: "Create Account",
          icon: "question",
          confirmButtonText: "Create Account",
          text: "Please check the details provided.",
          showLoaderOnConfirm: true,
          preConfirm: () => {
            this.$Progress.start();
            return new Promise((resolve, reject) => {
              axios
                .post("/api/account", this.form)
                .then(response => {
                  const user = response.data;
                  resolve(user);
                })
                .catch(e => {
                  this.$Progress.fail();
                  console.log(e);
                  swal.showValidationMessage(`Unable to create account`);
                  swal.hideLoading();
                  reject(e);
                });
            });
          }
        })
        .then(result => {
          if (result.value) {
            this.$Progress.finish();
            console.log(result);
            swal.fire({
              title: "Account Succesfully Created",
              icon: "success",
              timer: "2500",
              onClose: () => {
                this.$router.push({ name : "account_index"});
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