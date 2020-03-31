<template>
  <div>
    <div class="text-center">
      <div class="mb-4">
        <img src="/img/logo/pd-logo.png" width="80" height="110" />
      </div>
      <div class="row">
        <!-- Initials -->
        <div class="col-md-4 text-right">
          <label>Initials:</label>
        </div>
        <div class="col-md-8 text-left">
          <label>VTM</label>
        </div>
        <!-- Full Name -->
        <div class="col-md-4 text-right">
          <label>Full Name</label>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.meta.full_name}}</label>
        </div>
        <!-- Department -->
        <div class="col-md-4 text-right">
          <label>Department:</label>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.job_details.department }}</label>
        </div>
        <!-- Group -->
        <div class="col-md-4 text-right">
          <label>Group:</label>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.job_details.group }}</label>
        </div>
        <!-- Position -->
        <div class="col-md-4 text-right">
          <label>Position:</label>
        </div>
        <div class="col-md-8 text-left">
          <label>CEO/President</label>
        </div>
        <!-- Job Level -->
        <div class="col-md-4 text-right">
          <label>Job Level:</label>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.job_details.job_level }}</label>
        </div>
        <!-- PD Email -->
        <div class="col-md-4 text-right">
          <label>PD Email:</label>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.pdem_email }}</label>
        </div>
        <!-- PD Gmail -->
        <div class="col-md-4 text-right">
          <label>PD Gmail:</label>
        </div>
        <div class="col-md-8 text-left">
          <label>{{ user.data.pdem_gmail }}</label>
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

<style>
</style>