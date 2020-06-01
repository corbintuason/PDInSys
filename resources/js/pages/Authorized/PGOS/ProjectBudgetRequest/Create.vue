<template>
    <div>
        <create-budget-request></create-budget-request>
    </div>
</template>

<script>
import createBudgetRequest from "../../Common/BudgetRequest/Create";
import { createBudgetRequestModule } from "../../../../store/modules/budget-request/create";
export default {
    data() {
        return {
            namespace: "create-budget-request",
        };
    },
    components: {
        "create-budget-request": createBudgetRequest,
    },
    methods:{
    
    },
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var namespace = "create-budget-request";
        this.$store.registerModule(namespace, createBudgetRequestModule);
        this.$store.commit(namespace+"/setType", "Project");
    },
    mounted() {
        console.log(this.namespace);
    },
};
</script>
