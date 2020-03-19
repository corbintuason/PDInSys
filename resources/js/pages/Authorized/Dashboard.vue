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
            <div class="col-md-12">
                <!-- Happening Now -->
                <!-- <happening-now></happening-now> -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <!-- My Calendar -->
                <my-calendar></my-calendar>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div><happening-now></happening-now></div>
                    </div>
                    <div class="col-md-6">
                        <div><company-advisories></company-advisories></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import adminNav from "../../components/authorized/navigation/AdminNav";
import welcomeUser from "../../components/authorized/dashboard/WelcomeUser";
import notificationCenter from "../../components/authorized/dashboard/NotificationCenter";
import happeningNow from "../../components/authorized/dashboard/HappeningNow";
import companyAdvisories from "../../components/authorized/dashboard/Advisories";
import myCalendar from "../../components/authorized/dashboard/MyCalendar";

export default {
    data() {
        return {
            user: this.$store.state.user
        };
    },
    components: {
        "admin-nav": adminNav,
        "welcome-user": welcomeUser,
        "notification-center": notificationCenter,
        "happening-now": happeningNow,
        "my-calendar": myCalendar,
        "company-advisories": companyAdvisories
        // "my-schedule": mySchedule
    },
    computed: {},
    methods: {},
    mounted() {}
};
</script>
