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
            <b-form-select v-model="form.bank_name.bank_name" required>
              <option disabled>Please select an option</option>
              <option>BDO</option>
              <option>BPI</option>
              <option>China Bank</option>
              <option>City Bank</option>
              <option>EastWest</option>
              <option>HSBC</option>
              <option>Landbank</option>
              <option>Metro Bank</option>
              <option>PNB</option>
              <option>RCBC</option>
              <option>Security Bank</option>
              <option>Union Bank</option>
            </b-form-select>
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
            bank_name: [{
                bank_name: "",
                account_name: "",
                account_number: ""
            }]
        };
    },

    components: {
        vueStep
    }
};
</script>

<style></style>
