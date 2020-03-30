<template>
  <div>
    <div id="account_details">
      <h1 class="component-sub-header">Payment Milestone</h1>
      <div class="component-sub-content">
        <div class="row">
          <div class="col-md-6">
            <b-input-group
              v-for="(value, value_index) in account.payment_milestone"
              :key="value_index"
            >
              <b-input :disabled="mode=='Show'" type="text" v-model="account.payment_milestone[value_index]"></b-input>
            </b-input-group>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import form from "../../../../../../mixins/form";
export default {
  data() {
    return {};
  },
  mixins: [form],
  props: {
    account: Object,
    mode: String
  }
};
</script>