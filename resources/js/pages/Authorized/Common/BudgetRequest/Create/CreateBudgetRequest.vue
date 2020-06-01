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
            <hr />
            <total-budget-requested></total-budget-requested>
        </b-card-body>
        <template v-slot:footer>
            <b-button
                class="float-right"
                variant="outline-success"
                @click="createBudgetRequest"
                >Create Budget Request</b-button
            >
        </template>
    </b-card>
</template>

<script>
import budgetRequestHeader from "./CreateBudgetRequest/BudgetRequestHeader";
import budgetRequestBody from "./CreateBudgetRequest/BudgetRequestBody";
import totalBudgetRequested from "./CreateBudgetRequest/TotalBudgetRequested";
import form from "../../../../../mixins/form"
import {mapState, mapGetters} from "vuex";
export default {
    data() {
        return {};
    },
    components: {
        "budget-request-header": budgetRequestHeader,
        "budget-request-body": budgetRequestBody,
        "total-budget-requested": totalBudgetRequested,
    },
    mixins:[form],
    computed:{
        ...mapState("create-budget-request", {
            budget_request: state => state.budget_request,
        }),
        ...mapGetters("create-budget-request", ["budget_request_form"])
    },
    methods: {
        createBudgetRequest() {
            var swal_object = {
                title: "Create Budget Request",
                icon: "question",
                confirmButtonText: "Create Budget Request",
                text: "Please check the details provided.",
                item: this.budget_request,
                endpoints: {
                    api: "/api/budget_request",
                    show_route: "budget_request_show",
                },
            };
            this.fireCreateSwal(swal_object);
        },
    },
};
</script>
