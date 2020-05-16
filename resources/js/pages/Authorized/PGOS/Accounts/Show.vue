<template>
    <div>
        <div v-if="account != null">
            <item-progress
                class="mt-3"
                :steps="steps"
                :item="account"
                :mode="'Show'"
            ></item-progress>
            <account></account>
            <change-logs :logs="account.actions"></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import account from "./Show/Account";
import accountModule from "../../../../store/modules/account";
import states from "../../../../mixins/states";

import { mapGetters, mapState } from "vuex";
export default {
    data() {
        return {
            account_id: this.$route.params.id,
            namespace: "account-" + this.$route.params.id
        };
    },
    components: {
        account: account,
    },
    mixins: [states],
    computed: {
        ...mapState({
            account(state, getters) {
                return getters[this.namespace + "/getItem"];
            },
            steps(state, getters) {
                return getters[this.namespace + "/getSteps"];
            },

        }),
    },
    watch: {},
    methods: {},
    beforeDestroy() {        
        console.log("look at me, account should be here", this.$store);
    this.$store.unregisterModule(this.namespace);
    },
    mounted() {
        this.registerStoreModule(this.namespace, accountModule).then(
            (response) => {
                this.$store.dispatch(
                    this.namespace + "/storeItem",
                    this.account_id
                );
            }
        );
    },
};
</script>
