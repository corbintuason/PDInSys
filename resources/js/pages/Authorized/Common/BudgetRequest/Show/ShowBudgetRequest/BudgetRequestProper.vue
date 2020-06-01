<template>
    <div>
        <!-- Header -->
        <budget-request-header></budget-request-header>
        <!-- Body  -->
        <budget-request-body></budget-request-body>
        <!-- Total Budget Requested -->
        <hr />
        <total-budget-requested></total-budget-requested>
    </div>
</template>

<script>
import budgetRequestHeader from "./BudgetRequestProper/BudgetRequestHeader";
import budgetRequestBody from "./BudgetRequestProper/BudgetRequestBody";
import totalBudgetRequested from "./BudgetRequestProper/TotalBudgetRequested";
export default{
    data(){
        return{}
    },
    components:{
        "budget-request-header": budgetRequestHeader,
        "budget-request-body": budgetRequestBody,
        "total-budget-requested": totalBudgetRequested,
    }
}
</script>
