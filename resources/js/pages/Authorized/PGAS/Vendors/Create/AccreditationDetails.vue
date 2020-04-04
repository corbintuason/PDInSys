<template>
  <div>
    <div class="text-center">
      <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
    </div>
    <hr />
    <div class="component-sub-content mt-4 mb-4">
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="row">
            <div class="col-md-2 mt-1">
              <label for="bir-cert">BIR 2303:</label>
            </div>
            <div class="col-md-8">
              <b-form-file id="bir-cert" required></b-form-file>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="row">
            <div class="col-md-3 mt-1">
              <label for="dti-cert">DTI Certificate:</label>
            </div>
            <div class="col-md-8">
              <b-form-file id="dti-cert"></b-form-file>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-2 mt-1">
              <label for="invoice">Sales Invoice:</label>
            </div>
            <div class="col-md-8">
              <b-form-file id="invoice" required></b-form-file>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-3 mt-1">
              <label for="sec-cert">SEC Certificate:</label>
            </div>
            <div class="col-md-8">
              <b-form-file id="sec-cert"></b-form-file>
            </div>
          </div>
        </div>
        <div class="col-md-6 mt-3">
          <div class="row">
            <div class="col-md-2 mt-1">
              <label for="official-receipt">Official Receipt:</label>
            </div>
            <div class="col-md-8">
              <b-form-file id="official-receipt" required></b-form-file>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vueStep from "vue-step";
export default {
    data() {
        return {
            nowStep: 4,
            stepList: ["", "", "", ""]
        };
    },
    components: {
        vueStep
    }
};
</script>

<style></style>
