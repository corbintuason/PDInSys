<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Progress Bar</h1>
      </template>
      <b-card-text>
        <step-progress :steps="my_steps" current-step="0" icon-class="fa fa-check"></step-progress>
      </b-card-text>
    </b-card>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Create Project</h1>
      </template>
      <b-card-text>
        <div class="row">
          <div class="col-md-6">
            <!-- Project Name -->
            <label>Project Name</label>
            <b-input type="text"></b-input>
            <!-- Account -->
            <label>Account</label>
            <b-form-select :options="account_options" v-model="form.selected_account">
              <template v-slot:first>
                <b-form-select-option :value="null" disabled>-- Please select an account --</b-form-select-option>
              </template>
            </b-form-select>
            <!-- Client -->
            <!-- Brand -->
            <!-- Department -->
            <!-- Start Date -->
            <!-- End Date -->
            <!-- Locations -->
            <!-- Project Status -->
            <!-- Project Score -->
            <!-- Project Bidding -->
            <!-- Departments Needed -->
          </div>
        </div>
      </b-card-text>
    </b-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      my_steps: ["Create", "Review", "Approve"],
      form: {
        selected_account: null
      },
      account_options: [{ value: 1, text: "GLOBE" }]
    };
  },

  components: {}
};
</script>