<template>
    <div>
        <!-- Header -->
        <budget-request-header></budget-request-header>
        <!-- Body  -->
        <budget-request-body></budget-request-body>
        <!-- Total Budget Requested -->
        <hr />
        <!-- <reference-number class="col-md-6"></reference-number> -->
        <budget-request-summary
            class="col-md-4 offset-md-8"
            namespace="show-budget-request"
        ></budget-request-summary>

        <!-- <b-button class="float-right" variant="outline-dark">
            <a :href='"/api/budget_request/"+this.budget_request.id+"/download"'>Download Budget Request</a>
        </b-button> -->
    </div>
</template>

<script>
import budgetRequestHeader from "./BudgetRequestProper/BudgetRequestHeader";
import budgetRequestBody from "./BudgetRequestProper/BudgetRequestBody";
import budgetRequestSummary from "../../components/BudgetRequestSummary";

import { mapState } from "vuex";
export default {
    data() {
        return {};
    },
    components: {
        "budget-request-header": budgetRequestHeader,
        "budget-request-body": budgetRequestBody,
        "budget-request-summary": budgetRequestSummary

    },
    computed: {
        ...mapState("show-budget-request", {
            budget_request: (state) => state.item,
        }),
    },
};
</script>
