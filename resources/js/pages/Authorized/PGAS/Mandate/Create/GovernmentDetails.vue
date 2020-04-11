<template>
  <div>
    <div class="text-center">
      <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
    </div>
    <hr />
    <div class="component-sub-content mt-4 mb-3">
      <div class="text-center mt-4">
        <h5>
          <i>Government Details</i>
        </h5>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="sss">SSS No:</label>
          <b-input id="sss" type="number"></b-input>
        </div>
        <div class="col-md-6 mb-3">
          <label for="tin">TIN No:</label>
          <b-input id="tin" type="number"></b-input>
        </div>
        <div class="col-md-6">
          <label for="pagibig">PAGIBIG No:</label>
          <b-input id="pagibig" type="number"></b-input>
        </div>
        <div class="col-md-6">
          <label for="philhealth">PHILHEALTH No:</label>
          <b-input id="philhealth" type="number"></b-input>
        </div>
        <div class="col-md-12 mt-3">
          <label for="passport">PASSPORT No:</label>
          <b-input id="passport" type="number"></b-input>
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
	  		nowStep: 2,
			stepList: ["", "", "", ""],
		}
	},
	components: {
		vueStep
	}
}
</script>

<style>
</style>