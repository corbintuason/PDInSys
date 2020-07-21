<template>
    <div>
        <div v-if="!loading">
            <item-progress class="mt-3" :namespace="namespace"></item-progress>
            <account :namespace="namespace"></account>
            <change-logs :namespace="namespace"></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import account from "./Show/Account";
import { showAccountModule } from "../../../../store/modules/account/show";
import states from "../../../../mixins/states";

import { mapGetters, mapState } from "vuex";
export default {
    data() {
        return {
            namespace: "show-account"
        };
    },
    components: {
        account: account,
    },
    mixins: [states],
    computed: {
        ...mapState({
            loading(state) {
                return state[this.namespace].loading;
            },
        }),
    },
    watch: {},
    methods: {},
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var namespace = "show-account";
        var id = this.$route.params.id;
        return new Promise((resolve, reject) => {
            resolve(this.$store.registerModule(namespace, showAccountModule));
        }).then((response) => {
            this.$store.dispatch(namespace + "/storeItem", id);
        });
    },

    mounted() {},
};
</script>
