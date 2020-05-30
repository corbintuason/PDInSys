<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title">Create Budget Request</h1>
        </template>
        <b-card-body>
            <!-- Header -->
           <budget-request-header></budget-request-header>
           <!-- Body  -->
           <budget-request-body></budget-request-body>
           <!-- Total Budget Requested -->
           <hr>
           <total-budget-requested></total-budget-requested>
        </b-card-body>
    </b-card>
</template>

<script>
import budgetRequestHeader from "./CreateBudgetRequest/BudgetRequestHeader"
import budgetRequestBody from "./CreateBudgetRequest/BudgetRequestBody"
import totalBudgetRequested from "./CreateBudgetRequest/TotalBudgetRequested"
export default {
    data() {
        return {};
    },
    components:{
        "budget-request-header": budgetRequestHeader,
        "budget-request-body": budgetRequestBody,
        "total-budget-requested": totalBudgetRequested
    }
};
</script>
