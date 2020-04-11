<template>
  <div>
    <div class="text-center">
      <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
    </div>
    <hr />
    <div class="text-center mt-4">
      <h5>
        <i>Other Information</i>
      </h5>
    </div>
    <div class="component-sub-content mt-4 mb-3">
      <div class="row">
        <!-- Father's -->
        <div class="col-md-6 mb-3">
          <label for="father">Father's Name:</label>
          <b-input id="father" type="text"></b-input>
        </div>
        <div class="col-md-6 mb-3">
          <label for="father">Occupation:</label>
          <b-input id="father" type="text" placeholder="Father's Occupation"></b-input>
        </div>
        <!-- Mother's -->
        <div class="col-md-6 mb-3">
          <label for="mother">Mother's Name:</label>
          <b-input id="mother" type="text"></b-input>
        </div>
        <div class="col-md-6 mb-3">
          <label for="mother">Occupation:</label>
          <b-input id="mother" type="text" placeholder="Mother's Occupation"></b-input>
        </div>
        <!-- Spouse's -->
        <div class="col-md-6 mb-3">
          <label for="spouse">Spouse's Name:</label>
          <b-input id="spouse" type="text"></b-input>
        </div>
        <div class="col-md-6 mb-3">
          <label for="spouse">Occupation:</label>
          <b-input id="spouse" type="text" placeholder="Spouse's Occupation"></b-input>
        </div>
      </div>
      <div class="text-center mt-4">
        <h5>
          <i>In Case of Emergency</i>
        </h5>
      </div>
      <!-- contact person -->
      <div class="row">
        <div class="col-md-6">
          <label for="contact-person">Contact Person:</label>
        </div>
        <div class="col-md-5">
          <label for="contact-number">Contact Number:</label>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6 mb-3">
          <b-input id="contact-person" type="text"></b-input>
        </div>
        <div class="col-md-5 mb-3">
          <b-input id="contact-number" type="number" placeholder="09xx-xxx-xxx"></b-input>
        </div>
        <div class="col-md-1 mb-3">
          <b-button id="delete-button" :disabled="value_index==0" variant="outline-danger">
            <i class="fas fa-trash"></i>
          </b-button>
        </div>
      </div>

      <div class="mt-2">
        <b-button variant="success" block>
          <i class="fas fa-plus"></i>
          <strong>Add Contact Person</strong>
        </b-button>
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
	  		nowStep: 4,
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