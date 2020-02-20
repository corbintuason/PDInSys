<template>
  <div>
    <div>
      <admin-nav></admin-nav>
      <div class="content-wrapper">
        <div class="content">
          <div class="container-fluid">
            <!-- Welcome -->
            <div class="row mt-3">
              <div class="col-md-4">
                <welcome-user></welcome-user>
              </div>
              <!-- Advisories -->

              <div class="col-md-8">
                <advisories></advisories>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <!-- Happening Now -->
                <happening-now></happening-now>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <!-- My Schedule -->
                <my-schedule></my-schedule>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import adminNav from "../../components/authorized/navigation/AdminNav";
import welcomeUser from "../../components/authorized/dashboard/WelcomeUser";
import advisories from "../../components/authorized/dashboard/Advisories";
import happeningNow from "../../components/authorized/dashboard/HappeningNow";
import mySchedule from "../../components/authorized/dashboard/MySchedule";

export default {
  data() {
    return {
      user: this.$store.state.user
    };
  },
  components: {
    "admin-nav": adminNav,
    "welcome-user": welcomeUser,
    advisories: advisories,
    "happening-now": happeningNow,
    "my-schedule": mySchedule
  },
  computed: {},
  methods: {},
  mounted() {}
};
</script>
