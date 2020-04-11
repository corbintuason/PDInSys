<template>
  <div>
    <div class="text-center">
      <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
    </div>
    <hr />
    <div class="text-center mt-4">
      <h5>
        <i>Educational Attainment</i>
      </h5>
    </div>
    <div class="component-sub-content mt-4 mb-3">
      <div class="row">
        <!-- Tertiary -->
        <div class="col-md-6 mb-3">
          <label for="tertiary">Tertiary:</label>
          <i style="color: gray">(any type of education pursued beyond the high school level)</i>
          <b-input id="tertiary" type="text"></b-input>
        </div>
        <div class="col-md-6 mb-3">
          <label for="tertiary-date">Year Graduated:</label>
          <b-input id="tertiary-date" type="number" placeholder="Tertiary"></b-input>
        </div>
        <!-- Secondary -->
        <div class="col-md-6 mb-3">
          <label for="secondary">Secondary Level:</label>
          <b-input id="secondary" type="text"></b-input>
        </div>
        <div class="col-md-6 mb-3">
          <label for="secondary-date">Year Graduated:</label>
          <b-input id="secondary-date" type="number" placeholder="Secondary"></b-input>
        </div>
        <!-- Primary -->
        <div class="col-md-6 mb-3">
          <label for="primary">Primary Level:</label>
          <b-input id="primary" type="text"></b-input>
        </div>
        <div class="col-md-6 mb-3">
          <label for="primary-date">Year Graduated:</label>
          <b-input id="primary-date" type="number" placeholder="Primary"></b-input>
        </div>
      </div>
      <div class="text-center mt-4">
        <h5>
          <i>Work Experience</i>
        </h5>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label for="position">Position:</label>
        </div>
        <div class="col-md-4">
          <label for="job-description">Job Description:</label>
        </div>
        <div class="col-md-2">
          <label for="start-date">Start Date:</label>
        </div>
        <div class="col-md-2">
          <label for="end-date">End Date:</label>
        </div>
        <div class="col-md-1"></div>
      </div>
      <div class="row">
        <!-- Position -->
        <div class="col-md-3 mb-3">
          <b-input id="position" type="text"></b-input>
        </div>
        <!-- Job Description -->
        <div class="col-md-4 mb-3">
          <b-input id="job-description" type="text"></b-input>
        </div>
        <!-- Start Date -->
        <div class="col-md-2 mb-3">
          <b-form-datepicker id="start-date" locale="en"></b-form-datepicker>
        </div>
        <!-- End Date -->
        <div class="col-md-2 mb-3">
          <b-form-datepicker id="end-date" locale="en"></b-form-datepicker>
        </div>

        <div class="col-md-1">
          <b-button id="delete-button" :disabled="value_index==0" variant="outline-danger">
            <i class="fas fa-trash"></i>
          </b-button>
        </div>
      </div>

      <div class="mt-2">
        <b-button variant="success" block>
          <i class="fas fa-plus"></i>
          <strong>Add Work</strong>
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
	  		nowStep: 3,
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