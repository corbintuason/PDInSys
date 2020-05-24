<template>
    <div>
        <div v-if="!loading">
            <item-progress
                class="mt-3"
                :namespace="namespace"
            ></item-progress>
            <account :namespace="namespace"></account>
            <change-logs :namespace="namespace"></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import account from "./Show/Account";
import { accountModule } from "../../../../store/modules/account";
import states from "../../../../mixins/states";

import { mapGetters, mapState } from "vuex";
export default {
    data() {
        return {
            account_id: this.$route.params.id,
            namespace: "account-" + this.$route.params.id,
        };
    },
    components: {
        account: account,
    },
    mixins: [states],
    computed: {
        ...mapState({
            loading(state){
                return state[this.namespace].loading;
            }
        })
    },
    watch: {},
    methods: {},
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var id = this.$route.params.id;
        var namespace = "account-" + id;
        return new Promise((resolve, reject) => {
            resolve(this.$store.registerModule(namespace, accountModule));
        }).then((response) => {
            this.$store.dispatch(namespace + "/storeItem", id);
        });
    },

    mounted(){
        
    }
};
</script>
