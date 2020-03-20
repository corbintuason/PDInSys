<template>
  <div>
      <!-- Welcome -->
      <div class="row mt-3">
        <div class="col-md-4">
          <welcome-user></welcome-user>
        </div>
        <!-- Advisories -->

        <div class="col-md-8">
          <notification-center></notification-center>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <!-- Happening Now -->
          <happening-now></happening-now>
        </div>
        <div class="col-md-6">
          <!-- Advisories -->
          <advisories></advisories>

        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- My Schedule -->
          {{user.data.module_access}}
        </div>
      </div>
  </div>
</template>

<script>
import welcomeUser from "./Dashboard/WelcomeUser";
import notificationCenter from "./Dashboard/NotificationCenter";
import happeningNow from "./Dashboard/HappeningNow";
import mySchedule from "./Dashboard/MySchedule";
import advisories from "./Dashboard/Advisories"
export default {
  data() {
    return {
      user: this.$store.state.user
    };
  },
  components: {
    "welcome-user": welcomeUser,
    "notification-center": notificationCenter,
    "happening-now": happeningNow,
    "my-schedule": mySchedule,
    "advisories": advisories
  },
  computed: {},
  methods: {
    tester(){
      // this.user.data.module_access.forEach(pdis_module => {
      //   console.log(pdis_module);
      // });
      console.log(typeof this.user.data.job_details)
    }
  },
  mounted() {
    this.tester();
  }
};
</script>
