<template>
    <div>
        <div v-if="!loading">
            <!-- Progress Bar -->

            <item-progress class="mt-3" :namespace="namespace"></item-progress>

            <!-- Main Project Details -->

            <show-budget-request :namespace="namespace"></show-budget-request>

            <!-- Change Logs  -->
            <change-logs :namespace="namespace"></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import showBudgetRequest from "./Show/ShowBudgetRequest";
import { showBudgetRequestModule } from "../../../../store/modules/budget-request/show";
import {mapState} from "vuex";

export default {
    data() {
        return {
            namespace: "show-budget-request",
        };
    },
    components: {
        "show-budget-request": showBudgetRequest,
    },
    computed:{
        ...mapState('show-budget-request', {
            loading: state => state.loading
        })
    },
    methods:{

    },
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var namespace = "show-budget-request";
        var br_id = this.$route.params.id;
        this.$store.registerModule(namespace, showBudgetRequestModule);
        this.$store.dispatch(namespace+"/storeItem", br_id);
    },
    mounted() {
        console.log(this.namespace);
    },
};
</script>