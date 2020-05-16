<template>
  <div>
    <div id="account_details">
      <h1 class="component-sub-header">Terms of Payment</h1>
      <div class="component-sub-content">
        <div class="row">
          <div class="col-md-6">
            <b-input-group
              v-for="(value, value_index) in account.terms_of_payment"
              :key="value_index"
            >
              <b-input :disabled='mode=="Show"' type="text" v-model="account.terms_of_payment[value_index]"></b-input>
            </b-input-group>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import form from "../../../../../../mixins/form";
import {mapState} from "vuex";
export default {
  data() {
    return {
                  namespace: "account-" + this.$route.params.id,

    };
  },
  mixins: [form],
  computed:{
               ...mapState({
            account(state, getters) {
                return getters[this.namespace + "/getItem"];
            },
            mode(state, getters) {
                return getters[this.namespace + "/getMode"];
            },
        }),
  }
};
</script>