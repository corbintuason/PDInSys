<template>
    <div>
    <!-- ITEM PROGRESS -->

    <!-- ACTUAL FORM -->
    <create-budget-request></create-budget-request>
    </div>
</template>

<script>
import createBudgetRequest from "./Create/CreateBudgetRequest"

export default{
    data(){
        return{

        }
    },
    components:{
        "create-budget-request": createBudgetRequest
    }
}
</script>
