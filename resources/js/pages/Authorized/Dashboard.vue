<template>
  <div>
    <!-- Welcome -->
    <div class="row mt-3">
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
            <!-- <all-employee></all-employee> -->
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
      user: this.$store.state.user,
      users: [],
      roomId: 1
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
  
  created() {
    console.log('trying ~~~');
    console.log(window.location.hostname);
    console.log(this.$store);
    // axios.get("/api/init").then(response => {
    //   console.log(response);
    // });
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
