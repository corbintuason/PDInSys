<template>
    <div>
        <div v-if="!loading">
            <item-progress class="mt-3" :namespace="namespace"></item-progress>
            <mandate :namespace="namespace"></mandate>
            <change-logs :namespace="namespace"></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import mandate from "./Show/Mandate";
import { mandateModule } from "../../../../store/modules/mandate";
import states from "../../../../mixins/states";

import { mapGetters, mapState } from "vuex";
export default {
    data() {
        return {
            mandate_id: this.$route.params.id,
            namespace: "mandate-" + this.$route.params.id,
        };
    },
    components: {
        mandate: mandate,
    },
    mixins: [states],
    computed: {
        ...mapState({
            loading(state) {
                return state[this.namespace].loading;
            },
        }),
        // ...mapState({
        //     mandate(state, getters) {
        //         return getters[this.namespace + "/getItem"];
        //     },
        //     steps(state, getters) {
        //         return getters[this.namespace + "/getSteps"];
        //     },
        // }),
    },
    watch: {},
    methods: {},
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var id = this.$route.params.id;
        var namespace = "mandate-" + id;
        return new Promise((resolve, reject) => {
            resolve(this.$store.registerModule(namespace, mandateModule));
        }).then((response) => {
            this.$store.dispatch(namespace + "/storeItem", id);
        });
    },

    mounted() {},
};
</script>
