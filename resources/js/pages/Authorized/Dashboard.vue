<template>
  <div>
    <!-- Welcome -->
    <div class="row mt-5">
      <div class="col-md-4">
        <welcome-user></welcome-user>
      </div>
      <div class="col-md-8">
        <notification-center></notification-center>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <my-calendar></my-calendar>
      </div>
      <div class="col-md-8 mb-0">
        <div class="row">
          <div class="col-md-6">
            <all-employee></all-employee>
          </div>
          <div class="col-md-6">
            <advisories></advisories>
            <happening-now></happening-now>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import welcomeUser from "./Dashboard/WelcomeUser";
import notificationCenter from "./Dashboard/NotificationCenter";
import happeningNow from "./Dashboard/HappeningNow";
import myCalendar from "./Dashboard/MyCalendar";
import allEmployee from "./Dashboard/AllEmployee";
import advisories from "./Dashboard/Advisories";
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
	"my-calendar": myCalendar,
	"advisories": advisories,
	"all-employee": allEmployee,
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

<style lang="scss">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
</style>
