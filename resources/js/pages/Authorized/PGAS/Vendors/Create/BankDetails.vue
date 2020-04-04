<template>
  <div>
    <div class="text-center">
      <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
    </div>
    <hr />
    <div class="component-sub-content mt-4 mb-4">
      <div class="row">
        <!-- Bank Name -->
        <div class="col-md-4">
          <div class="form-group">
            <label>Bank Name</label>
            <b-input-group>
              <b-input v-model="form.bank_name.bank_name" type="text"></b-input>
            </b-input-group>
          </div>
        </div>
        <div class="col-md-4">
          <!-- Account Name -->
          <div class="form-group">
            <label>Account Name</label>
            <b-input-group>
              <b-input v-model="form.bank_name.account_name" type="text"></b-input>
            </b-input-group>
          </div>
        </div>
        <div class="col-md-4">
          <!-- Account Number -->
          <div class="form-group">
            <label>Account Number</label>
            <b-input-group>
              <b-input v-model="form.bank_name.account_number" type="text"></b-input>
            </b-input-group>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vueStep from "vue-step";
export default {
    props: {
        form: Object
    },
    data() {
        return {
            nowStep: 3,
            stepList: ["", "", "", ""],
            bank_name: {
                bank_name: "",
                account_name: "",
                account_number: ""
            }
        };
    },

    components: {
        vueStep
    }
};
</script>

<style></style>
