<template>
    <div>
        <b-card class="mt-5">
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
                            >Account Settings</a
                        >
                        <a
                            class="nav-link"
                            id="v-pills-change-password-tab"
                            data-toggle="pill"
                            href="#v-pills-change-password"
                            role="tab"
                            aria-controls="v-pills-change-password"
                            aria-selected="false"
                            >Change Password</a
                        >
                        <a
                            class="nav-link"
                            id="v-pills-activity-log-tab"
                            data-toggle="pill"
                            href="#v-pills-activity-log"
                            role="tab"
                            aria-controls="v-pills-activity-log"
                            aria-selected="false"
                            >Activity Log</a
                        >
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
</template>

<script>
import accountSettings from "./Edit/AccountSettings";
import changePassword from "./Edit/ChangePassword";
import activityLog from "./Edit/ActivityLog";
export default {
    data() {
        return {};
    },
    components: {
        "account-settings": accountSettings,
        "change-password": changePassword,
        "activity-log": activityLog
    }
};
</script>

<style lang="scss" scoped>
* {
    font-family: "Lato";
}
.user-profile-card {
    margin-top: 37px;

    .left-side-settings {
        border-right: 2px solid #757d85;
    }
}
</style>
