<template>
    <div>
        <div v-if="mandate != null">
            <item-progress
                class="mt-3"
                :steps="steps"
                :item="mandate"
                :mode="'Show'"
            ></item-progress>
            <mandate></mandate>
            <change-logs :logs="mandate.actions"></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import mandate from "./Show/Mandate";
import mandateModule from "../../../../store/modules/mandate";
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
            mandate(state, getters) {
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
        console.log("look at me, mandate should be here", this.$store);
        this.$store.unregisterModule(this.namespace);
    },
    mounted() {
        this.registerStoreModule(this.namespace, mandateModule).then(
            (response) => {
                this.$store.dispatch(
                    this.namespace + "/storeItem",
                    this.mandate_id
                );
            }
        );
    },
};
</script>
