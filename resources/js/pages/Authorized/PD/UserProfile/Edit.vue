<template>
  <div>
    <b-breadcrumb class="mt-4">
      <b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
      <b-breadcrumb-item active>My Profile</b-breadcrumb-item>
    </b-breadcrumb>
    <div class="row">
      <div class="col-md-5 employee-info-card">
        <b-card header-bg-variant="primary" footer-bg-variant="primary">
          <template v-slot:header>
            <h1 class="component-title text-center">Employee Info</h1>
          </template>
          <template v-slot:footer></template>
          <employee-info></employee-info>
        </b-card>
      </div>

      <div class="col-md-7">
        <b-card class="card">
          <template v-slot:header>
            <h1 class="component-title">User Profile Settings</h1>
          </template>
          <div class="row">
            <div class="col-3 left-side-settings">
              <div
                class="nav flex-column nav-pills"
                id="v-pills-tab"
                role="tablist"
                aria-orientation="vertical"
              >
                <a
                  class="nav-link active"
                  id="v-pills-account-settings-tab"
                  data-toggle="pill"
                  href="#v-pills-account-settings"
                  role="tab"
                  aria-controls="v-pills-account-settings"
                  aria-selected="true"
                >Account Settings</a>
                <a
                  class="nav-link"
                  id="v-pills-change-password-tab"
                  data-toggle="pill"
                  href="#v-pills-change-password"
                  role="tab"
                  aria-controls="v-pills-change-password"
                  aria-selected="false"
                >Change Password</a>
                <a
                  class="nav-link"
                  id="v-pills-activity-log-tab"
                  data-toggle="pill"
                  href="#v-pills-activity-log"
                  role="tab"
                  aria-controls="v-pills-activity-log"
                  aria-selected="false"
                >Activity Log</a>
              </div>
            </div>
            <div class="col-9">
              <div class="tab-content" id="v-pills-tabContent">
                <div
                  class="tab-pane fade show active"
                  id="v-pills-account-settings"
                  role="tabpanel"
                  aria-labelledby="v-pills-account-settings-tab"
                >
                  <account-settings></account-settings>
                </div>
                <div
                  class="tab-pane fade"
                  id="v-pills-change-password"
                  role="tabpanel"
                  aria-labelledby="v-pills-change-password-tab"
                >
                  <change-password></change-password>
                </div>
                <div
                  class="tab-pane fade"
                  id="v-pills-activity-log"
                  role="tabpanel"
                  aria-labelledby="v-pills-activity-log-tab"
                >
                  <activity-log></activity-log>
                </div>
              </div>
            </div>
          </div>
        </b-card>
      </div>
    </div>
  </div>
</template>

<script>
import accountSettings from "./Edit/AccountSettings";
import changePassword from "./Edit/ChangePassword";
import activityLog from "./Edit/ActivityLog";
import employeeInfo from "./Edit/EmployeeInfo";
export default {
    data() {
        return {
            	user: JSON.parse(localStorage.getItem("user")),
        };
    },
    components: {
        "account-settings": accountSettings,
        "change-password": changePassword,
        "activity-log": activityLog,
        "employee-info": employeeInfo,
    }
};
</script>

<style lang="scss" scoped>

.employee-info-card {
  height: 100%;
  width: 100%;
}

.user-profile-card {
  margin-top: 37px;

  .left-side-settings {
    border-right: 2px solid #757d85;
  }
}
</style>
