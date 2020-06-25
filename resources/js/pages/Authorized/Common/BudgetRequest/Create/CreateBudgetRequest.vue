<template>
    <div>
        <b-card class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">Create Budget Request</h1>
            </template>
            <b-card-body>
                <!-- Header -->
                <budget-request-header></budget-request-header>
                <!-- Body  -->
                <budget-request-body namespace="create-budget-request"></budget-request-body>
                <!-- Total Budget Requested -->
                <hr />
                <div class = "row">
                <budget-request-summary class="col-md-4 offset-md-8" namespace="create-budget-request"></budget-request-summary>

                </div>
                <!-- <total-budget-requested namespace="create-budget-request"></total-budget-requested> -->
            </b-card-body>
            <template v-slot:footer>
                <b-button
                    class="float-right"
                    :disabled="reached_budget_limit"
                    variant="outline-success"
                    @click="changeShowBudgetRequestModal"
                    >View Budget Request</b-button
                >
            </template>
        </b-card>
        <view-budget-request namespace="create-budget-request"></view-budget-request>
    </div>
</template>

<script>
import budgetRequestHeader from "./CreateBudgetRequest/BudgetRequestHeader";
import budgetRequestBody from "./CreateBudgetRequest/BudgetRequestBody";
import totalBudgetRequested from "../components/TotalBudgetRequested";
import budgetRequestSummary from "../components/BudgetRequestSummary";
import viewBudgetRequest from "./CreateBudgetRequest/ViewBudgetRequest";
import form from "../../../../../mixins/form";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
    data() {
        return {};
    },
    components: {
        "budget-request-header": budgetRequestHeader,
        "budget-request-body": budgetRequestBody,
        "budget-request-summary": budgetRequestSummary,
        // "total-budget-requested": totalBudgetRequested,
        "view-budget-request": viewBudgetRequest
    },
    mixins: [form],
    computed: {
        ...mapState("create-budget-request", {
            budget_request: (state) => state.item,
        }),
        ...mapGetters("create-budget-request", [
            "reached_budget_limit",
        ]),
    },
    methods: {
        ...mapMutations("create-budget-request", {
            changeShowBudgetRequestModal(commit) {
                return commit("changeShowBudgetRequestModal", true);
            },
        }),
        // createBudgetRequest() {
        //     var swal_object = {
        //         title: "Create Budget Request",
        //         icon: "question",
        //         confirmButtonText: "Create Budget Request",
        //         text: "Please check the details provided.",
        //         item: this.budget_request,
        //         endpoints: {
        //             api: "/api/budget_request",
        //             show_route: "budget_request_show",
        //         },
        //     };
        //     this.fireCreateSwal(swal_object);
        // },
    },
};
</script>
