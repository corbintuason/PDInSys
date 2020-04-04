<template>
  <div>
    <div class="row text-center">
      <div class="col-md-3 text-right">
        <div>
          <b-img
            class="img-avatar"
            :src="user.data.official_photo"
            width="120px"
            height="120px"
            alt="Photo"
            rounded="circle"
            v-if="user.data.official_photo != null"
          ></b-img>
          <b-img
            class="img-avatar"
            src="/img/avatar/user.png"
            width="120px"
            height="120px"
            alt="Photo"
            rounded="circle"
            v-else
          ></b-img>
        </div>
      </div>
      <div class="col-md-9">
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
            <a class="employee-info text-white">{{ user.meta.full_name}}</a>
          </div>
          <!-- Department -->
          <div class="col-md-4 text-right">
            <b-badge variant="light">
              <h6>Department:</h6>
            </b-badge>
          </div>
          <div class="col-md-8 text-left">
            <a class="employee-info text-white">{{ user.data.job_details.department }}</a>
          </div>
          <!-- Group -->
          <div class="col-md-4 text-right">
            <b-badge variant="light">
              <h6>Group:</h6>
            </b-badge>
          </div>
          <div class="col-md-8 text-left">
            <a class="employee-info text-white">{{ user.data.job_details.group }}</a>
          </div>
          <!-- Position -->
          <div class="col-md-4 text-right">
            <b-badge variant="light">
              <h6>Position:</h6>
            </b-badge>
          </div>
          <div class="col-md-8 text-left">
            <a class="employee-info text-white">{{ user.data.job_details.position }}</a>
          </div>
          <!-- Job Level -->
          <div class="col-md-4 text-right">
            <b-badge variant="light">
              <h6>Job Level:</h6>
            </b-badge>
          </div>
          <div class="col-md-8 text-left">
            <a class="employee-info text-white">{{ user.data.job_details.job_level }}</a>
          </div>
          <!-- PD Email -->
          <div class="col-md-4 text-right">
            <b-badge variant="light">
              <h6>PD Email:</h6>
            </b-badge>
          </div>
          <div class="col-md-8 text-left">
            <a class="employee-info text-white">{{ user.data.pdem_email }}</a>
          </div>
          <!-- PD Gmail -->
          <div class="col-md-4 text-right">
            <b-badge variant="light">
              <h6>PD Gmail:</h6>
            </b-badge>
          </div>
          <div class="col-md-8 text-left">
            <a class="employee-info text-white">{{ user.data.pdem_gmail }}</a>
          </div>
          <!-- Birthday -->
          <div class="col-md-4 text-right">
            <b-badge variant="light">
              <h6>Birthday:</h6>
            </b-badge>
          </div>
          <div class="col-md-8 text-left">
            <a class="employee-info text-white">{{ user.data.birth_date }}</a>
          </div>
          <!-- Employment Date -->
          <div class="col-md-4 text-right">
            <b-badge variant="light">
              <h6>Employment Date:</h6>
            </b-badge>
          </div>
          <div class="col-md-8 text-left">
            <a class="employee-info text-white">{{ user.data.employment_date }}</a>
          </div>
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
.img-avatar {
  margin-left: 20px;
}
.employee-info {
  background: #f7942c;
  border-radius: 5px;
  padding: 5px;
}
</style>