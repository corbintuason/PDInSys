<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">
          Create Account & Client
          <strong class="orange float-right">{{user_role}}</strong>
        </h1>
      </template>
      <b-card-body v-if="account!=null">
        <b-card-text>
          <b-tabs content-class="mt-3" fill>
            <b-tab title="Account Information" active>
              <account-information :mode="mode" :account="account"></account-information>
            </b-tab>
            <b-tab title="Clients Information">
              <clients-information :account="account"></clients-information>
            </b-tab>
          </b-tabs>
        </b-card-text>
        </b-card-body>
        <template v-slot:footer>
          <!-- For Approval Status -->
          <template v-if="account.status=='For Approval'">
            <b-button
              variant="outline-success"
              class="float-right"
              @click="approveClient"
            >Approve Account and Clients</b-button>
          </template>
          <template v-if="mode=='Show'">
            <b-button
              variant="outline-primary"
              class="float-right"
              @click="switchMode('Edit')"
            >Edit Mode</b-button>
          </template>
          <template v-if="mode=='Edit'">
            <b-button
              variant="outline-primary"
              class="float-right"
              @click="switchMode('Show')"
            >Show Mode</b-button>
          </template>
        </template>
    </b-card>
  </div>
</template>

<script>
import form from "../../../../mixins/form";
import accountInformation from "./Show/AccountInformation";
import clientsInformation from "./Show/ClientsInformation";

export default {
  data() {
    return {};
  },
  mixins: [form],
  components: {
    "account-information": accountInformation,
    "clients-information": clientsInformation
  },
  props: {
    user: Object,
    account: Object,
    mode: String,
    user_role: String
  },
  methods: {
    approveClient() {
      // activate sweet alert
      const swal_object = {
        title: "Approve Client",
        icon: "question",
        confirmButtonText: "Are you sure?",
        text: "Testing"
      };

      const axios_form = {
        api_link: "/api/account/" + this.account.id,
        status: "Approved",
      };

      this.updateItem(swal_object, axios_form);
    },
    switchMode(mode) {
      swal
        .fire({
          title: mode + " Mode",
          text: "Proceeding will grant you access to " + mode + " mode",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Proceed!"
        })
        .then(result => {
          if (result.value) {
            this.$emit("update-mode", mode);
            swal.fire(
              mode + " Mode!",
              "You are now in" + mode + " Mode.",
              "success"
            );
          }
        });
    }
  },
  mounted() {
  }
};
</script>