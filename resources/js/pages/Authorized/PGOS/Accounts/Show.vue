<template>
    <div>
        <div v-if="account != null">
            <item-progress
                class="mt-3"
                :steps="steps"
                :item="account"
                :mode="'Show'"
            ></item-progress>
            <account :account="account"></account>
            <change-logs :logs="account.actions"></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import account from "./Show/Account";
import accountModule from "../../../../store/modules/account";
export default {
    data() {
        return {
            mode: "Show",
            steps: this.$store.state.account.steps,
            endpoints: {
                api: "/api/account/",
                show_route: "account_show",
            },
            account: null,
        };
    },
    components: {
        "account": account,
    },

    watch: {},
    methods: {
        loadAccount() {
            var account_id = this.$route.params.id;
            axios.get("/api/account/" + account_id).then((response) => {
                this.account = response.data.data;
            });
        },
    },
    mounted() {
        this.loadAccount();

        Fire.$on("switch-mode", (mode) => {
            if (mode == "Show") {
                this.loadAccount();
            }
            this.mode = mode;
        });
    },
};
</script>
