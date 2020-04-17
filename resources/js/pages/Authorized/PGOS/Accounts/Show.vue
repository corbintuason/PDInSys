<template>
    <div>
        <b-card v-if="account.status != 'Rejected'" class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">Progress Bar {{ mode }}</h1>
            </template>
            <b-card-body>
                <step-progress
                    :steps="front_steps"
                    :current-step="current_step"
                    icon-class="fa fa-check"
                ></step-progress>
                <br />
            </b-card-body>
        </b-card>
        <b-alert show v-else variant="danger" class="mt-3">This account has been <strong>Rejected</strong></b-alert>

        <!-- Create Account and Client -->
        <account-client
            v-if="account != null"
            :user="user"
            :account="account"
            :mode="mode"
            :user_role="user_role"
            @update-mode="updateMode"
        ></account-client>
        <!-- Change Logs -->
        <change-logs :logs="change_logs"></change-logs>
    </div>
</template>

<script>
import accountClient from "./AccountClient";
import changeLogs from "../../../../components/public/ChangeLogs";
export default {
    data() {
        return {
            mode: "Show",
            user: this.$store.state.user,
            change_logs: null,
            user_role: null,
            account: null,

            front_steps: this.$store.state.globals.statuses.account.front_steps,
            db_steps: this.$store.state.globals.statuses.account.db_steps,
            current_step: null,
        };
    },
    components: {
        "account-client": accountClient,
        "change-logs": changeLogs,
    },
    watch: {
        mode() {
            this.fireToast();
        },
    },
    methods: {
        getUserRole() {
            //("start");
            this.user_role = this.user.data.module_access[0]["modules"][0][
                "features"
            ][1]["role"];
        },
        getAccount() {
            var account_id = this.$route.params.id;
            axios.get("/api/account/" + account_id).then((response) => {
                this.account = response.data.data;
                this.change_logs = response.data.actions;
                console.log('watdafak');
                console.log(this.account);
                this.getCurrentStep();
                this.fireToast();
            }).catch(e => {
                console.log("dito palang mali na");
            });
        },

        getCurrentStep() {
            console.log("asdf");
            console.log(this.account);
            var status = this.account.status;
            var status_index = this.db_steps.indexOf(status) + 1;
            this.current_step = status_index;
        },

        updateMode(new_mode) {
            this.mode = new_mode;
        },
        switchMode(mode) {
            swal.fire({
                title: mode + " Mode",
                text: "Proceeding will grant you access to " + mode + " mode",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Proceed!",
                onDestroy: () => {
                    this.fireToast();
                },
            }).then((result) => {
                if (result.value) {
                    this.mode = mode;
                    swal.fire(
                        mode + " Mode!",
                        "You are now in" + mode + " Mode.",
                        "success"
                    );
                }
            });
        },
        fireToast() {
          if(this.account.status != 'Rejected'){
            var new_mode;
            if (this.mode == "Show") {
                new_mode = "Edit";
            } else {
                new_mode = "Show";
            }
            toast
                .fire({
                    icon: "question",
                    title: "Switch to " + new_mode + " Mode?",
                    showConfirmButton: true,
                })
                .then((result) => {
                    if (result.value) {
                        this.mode = new_mode;
                    }
                });
          }

        },
    },
    mounted() {
        // this.getUserRole();
        this.getAccount();
    },
};
</script>
