<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Progress Bar {{mode}}</h1>
      </template>
      <b-card-text>
        <step-progress :steps="front_steps" :current-step="current_step" icon-class="fa fa-check"></step-progress>
        <br />
      </b-card-text>
    </b-card>
    
    <!-- Create Account and Client -->
    <account-client v-if="account!=null" :user="user" :account="account" :mode="mode" :user_role="user_role" @update-mode="updateMode"></account-client>
    <!-- Change Logs -->
    <change-logs :logs="account.change_logs"></change-logs>
  </div>
</template>

<script>
import accountClient from "./AccountClient";
import changeLogs from "../../../../components/public/ChangeLogs"
export default {
  data() {
    return {
      mode: "Show",
      user: this.$store.state.user,
      user_role: null,
      account: null,

      front_steps: this.$store.state.globals.statuses.account.front_steps,
      db_steps: this.$store.state.globals.statuses.account.db_steps,      
      current_step: null,

    };
  },
  components: {
    "account-client": accountClient,
    "change-logs": changeLogs
  },
   methods: {
    getUserRole() {
      console.log("start");
      this.user_role = this.user.data.module_access[0]["modules"][0][
        "features"
      ][1]["role"];
    },
    getAccount() {
      var account_id = this.$route.params.id;
      axios.get("/api/account/" + account_id).then(response => {
        this.account = response.data.data;
        this.getCurrentStep();
      });
    },

    getCurrentStep() {
      var status = this.account.status;
      var status_index = this.db_steps.indexOf(status) + 1;
      this.current_step = status_index;
    },

    updateMode(new_mode){
      this.mode = new_mode;
    }
  },
  mounted() {
    this.getUserRole();
    this.getAccount();
  }
};
</script>