<template>
    <div>
        <div v-if="!loading">
            <!-- ITEM PROGRESS -->
            <item-progress :namespace="namespace"></item-progress>
            <!-- ACTUAL FORM -->
            <create-account :namespace="namespace"></create-account>
            <!-- <create-budget-request></create-budget-request> -->
        </div>
        <clip-loader color="orange" v-else></clip-loader>
    </div>
</template>

<script>
// import createBudgetRequest from "./Create/CreateBudgetRequest";
import createAccount from "./Create/CreateAccount";
import { createAccountModule } from "../../../../store/modules/account/create";
import { mapState, mapActions } from "vuex";
export default {
    data() {
        return {
            namespace: "create-account",
        };
    },
    computed: {
        ...mapState("create-account", {
            loading: (state) => state.loading,
        }),
    },
    components: {
      "create-account": createAccount
    },
    methods: {
        ...mapActions("create-account", {}),
    },
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var namespace = "create-account";
        this.$store.registerModule(namespace, createAccountModule);
    },
    mounted() {

    },
};
</script>
