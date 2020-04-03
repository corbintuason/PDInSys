<template>
  <div>
    <div class="text-center">
      <div class="mb-4">
        <img src="/img/logo/pd-logo.png" width="80" height="110" />
      </div>
      <div class="row">
        <!-- Initials -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>Initials:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <a class="employee-info text-white">VTM</a>
        </div>
        <!-- Full Name -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>Full Name:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.meta.full_name}}</label>
        </div>
        <!-- Department -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>Department:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.job_details.department }}</label>
        </div>
        <!-- Group -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>Group:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.job_details.group }}</label>
        </div>
        <!-- Position -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>Position:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.job_details.position }}</label>
        </div>
        <!-- Job Level -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>Job Level:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.job_details.job_level }}</label>
        </div>
        <!-- PD Email -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>PD Email:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.pdem_email }}</label>
        </div>
        <!-- PD Gmail -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>PD Gmail:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.pdem_gmail }}</label>
        </div>
        <!-- Birthday -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>Birthday:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.birth_date }}</label>
        </div>
        <!-- Employment Date -->
        <div class="col-md-4 text-right">
          <b-badge variant="light">
            <h6>Employment Date:</h6>
          </b-badge>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.employment_date }}</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            	user: JSON.parse(localStorage.getItem("user")),
        };
    },
}
</script>

<style scoped>
* {
  margin-bottom: 0px;
  margin-top: 0px;
}
.employee-info {
  background: #f7942c;
  border-radius: 5px;
  padding: 5px;
}
</style>