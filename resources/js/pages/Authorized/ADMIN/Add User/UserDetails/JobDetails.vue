<template>
  <div id="job_description">
    <div class="component-sub-header">Job Details</div>
    <div class="component-sub-content">
      <!-- OFFICE:  Choose between PGOS or PGAS -->
      <label>Office</label>
      <b-form-select v-model="selected_office">
        <b-form-select-option :value="null" disabled>-- Please select an Office --</b-form-select-option>
        <b-form-select-option
          v-for="(office, office_index) in offices"
          :key="office_index"
          :value="office"
        >{{office.name}}</b-form-select-option>
      </b-form-select>

      <label class="mt-2">Group</label>
      <b-alert variant="dark" v-if="selected_office == null" show>Please select an office first</b-alert>
      <b-form-select v-else v-model="selected_group">
        <b-form-select-option :value="null" disabled>-- Please select a Group--</b-form-select-option>
        <b-form-select-option
          v-for="(group, group_index) in selected_office.groups"
          :key="group_index"
          :value="group"
        >{{group.name}}</b-form-select-option>
      </b-form-select>

      <label>Department</label>
      <b-alert variant="dark" v-if="selected_group == null" show>Please select a Group first</b-alert>
      <b-form-select v-else v-model="selected_department">
        <b-form-select-option :value="null" disabled>-- Please select a Department--</b-form-select-option>
        <b-form-select-option
          v-for="(department, department_index) in selected_group.departments"
          :key="department_index"
          :value="department"
        >{{department.name}}</b-form-select-option>
      </b-form-select>

      <label>Position</label>
      <b-alert
        variant="dark"
        v-if="selected_department == null"
        show
      >Please select a Department first</b-alert>
      <b-form-select v-else v-model="selected_position">
        <b-form-select-option :value="null" disabled>-- Please select a Position--</b-form-select-option>
        <b-form-select-option
          v-for="(position, position_index) in selected_department.positions"
          :key="position_index"
          :value="position"
        >{{position }}</b-form-select-option>
      </b-form-select>

      <label>Job Level</label>
      <b-form-select v-model="new_user.job_details.job_level" :options="job_levels"></b-form-select>

      <!-- Choose between available groups -->
      <!-- Choose between available positions -->
    </div>

    <!-- GROUP -->
    <!-- <div class="container">
		<div class="row">
		  <div class="col-md-6">
			<div class="row">
			  <label for="group">Group</label>
			  <b-input id="group" v-model="new_user.group"></b-input>
			</div>
			<div class="row">
			  <label for="group">Job Level</label>
			  <b-form-select :options="job_levels">
				<template v-slot:first>
				  <b-form-select-option :value="null" disabled>Select Level</b-form-select-option>
				</template>
			  </b-form-select>
			  <b-input id="group" v-model="new_user.group"></b-input>
			</div>
		  </div>
		  <div class="col-md-4">
			<b-input type="number"></b-input>
		  </div>
		</div>
    </div>-->
  </div>
</template>

<script>
import validators from "../../../../../mixins/validators";
export default {
  data() {
	return {
	  offices: this.$store.state.globals.offices,
	  job_levels: this.$store.state.globals.job_levels,
	  selected_office: null,
	  selected_group: null,
	  selected_department: null,
	  selected_position: null,
	};
  },
  watch:{
	  selected_office(){
		  this.selected_group = null;
		  this.selected_department = null;
		  this.selected_position = null;
	  },
	  selected_department(){
		  this.new_user.job_details.office = this.selected_office.name;
		  this.new_user.job_details.group = this.selected_group.name;
		  this.new_user.job_details.department = this.selected_department;
		  this.new_user.job_details.position = this.selected_position;
	  }
  },
  mixins: [validators],
  props: {
	new_user: Object
  },
  methods: {
	/* 
	Required:
	  - PARAMETERS:
		- item: Object to be used for verification purposes
	  - DESCRIPTION:
		- This function is responsible for validating if the string is empty or not.
	*/

	onFileChange(e) {
	  const file = e.target.files[0];
	  this.new_user.official_photo = URL.createObjectURL(file);
	}
  }
};
</script>