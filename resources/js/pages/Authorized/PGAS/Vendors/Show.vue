<template>
    <div>
        <div v-if="!loading">
            <item-progress class="mt-3" :namespace="namespace"></item-progress>
            <vendor :namespace="namespace"></vendor>
            <change-logs :namespace="namespace"></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import vendor from "./Show/Vendor";
import { vendorModule } from "../../../../store/modules/vendor";
import states from "../../../../mixins/states";

import { mapGetters, mapState } from "vuex";
export default {
    data() {
        return {
            vendor_id: this.$route.params.id,
            namespace: "vendor-" + this.$route.params.id,
        };
    },
    components: {
        vendor: vendor,
    },
    mixins: [states],
    computed: {
        ...mapState({
            loading(state) {
                return state[this.namespace].loading;
            },
        }),
        // ...mapState({
        //     vendor(state, getters) {
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
        var namespace = "vendor-" + id;
        return new Promise((resolve, reject) => {
            resolve(this.$store.registerModule(namespace, vendorModule));
        }).then((response) => {
            this.$store.dispatch(namespace + "/storeItem", id);
        });
    },

    mounted() {},
};
</script>

<style></style>
