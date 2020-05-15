<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">
         {{account.code}}
        </h1>
      </template>
      <b-card-body>
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
                <show-process-buttons
                :mode="mode"
                :item="account"
                :item_model="'Account'"
                :steps="steps"
                :endpoints="endpoints"
            ></show-process-buttons>
          <!-- For Approval Status -->
        </template>
    </b-card>
  </div>
</template>

<script>
import form from "../../../../../mixins/form";
import accountInformation from "./AccountInformation";
import clientsInformation from "./ClientsInformation";

export default {
  data() {
    return {
        mode: "Show",
        steps: this.$store.state.account.steps,
        endpoints:{
            api: "/api/account/" + this.account.id
        }
    };
  },
  mixins: [form],
  components: {
    "account-information": accountInformation,
    "clients-information": clientsInformation
  },
  props: {
    user: Object,
    account: Object,
    user_role: String
  },
  methods: {
  },
  mounted() {
  }
};
</script>