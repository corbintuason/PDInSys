<template>
    <div>
        <div v-if="!loading">
            <!-- ITEM PROGRESS -->
            <item-progress namespace="create-budget-request"></item-progress>
            <!-- ACTUAL FORM -->
            <create-budget-request></create-budget-request>
        </div>
        <clip-loader color="orange" v-else></clip-loader>
    </div>
</template>

<script>
import createBudgetRequest from "./Create/CreateBudgetRequest";
import { mapState, mapActions } from "vuex";
export default {
    data() {
        return {};
    },
    computed: {
        ...mapState("create-budget-request", {
            type: (state) => state.type,
            loading: state => state.loading
        }),
    },
    components: {
        "create-budget-request": createBudgetRequest,
    },
    methods: {
        ...mapActions("create-budget-request", {
            loadParentRequirement(dispatch) {
                var parent_id;
                if(this.type == 'Project'){
                    parent_id = this.$route.params.id;
                }else{
                    parent_id = 0;
                }
                return dispatch("loadParentRequirement", parent_id);
            },
        }),
    },
    mounted() {
        console.log(
            "check the type asap",
            this.$store.state["create-budget-request"].type
        );
        console.log("ggwp");
        console.log(this.$route.params.id +" ?");
        this.loadParentRequirement();
    },
};
</script>
