<template>
    <div>
        <b-card class="mt-3">
            <template v-slot:header>
                <item-header :namespace="namespace"></item-header>
            </template>
            <b-card-body>
                <b-tabs fill>
                    <b-tab title="Budget Request Proper">
                        <budget-request-proper></budget-request-proper>
                    </b-tab>
                    <b-tab title="Liq. Journal" :disabled="!budget_request.is_process_finished">
                        <liquidation-journal v-if="budget_request.is_process_finished"></liquidation-journal>
                    </b-tab>
                </b-tabs>
            </b-card-body>
            <template v-slot:footer>
                <show-process-buttons
                    :namespace="namespace"
                ></show-process-buttons>
                <!-- <b-button class="float-right" @click="approveBudgetRequest" variant="outline-success" v-else>Approve Budget Request</b-button> -->
            </template>
        </b-card>
        <release-budget-request></release-budget-request>
        <disburse-budget-request></disburse-budget-request>
    </div>
</template>
<script>
import itemHeader from "../../../../../components/authorized/public/ItemHeader";
import budgetRequestProper from "./ShowBudgetRequest/BudgetRequestProper"
import form from "../../../../../mixins/form";
import liquidationJournal from "./ShowBudgetRequest/LiquidationJournal"
import releaseBudgetRequest from "./ReleaseBudgetRequest";
import disburseBudgetRequest from "./DisburseBudgetRequest";
import { mapState, mapGetters } from "vuex";
export default {
    data() {
        return {
            namespace: "show-budget-request",
        };
    },
    components: {
        "item-header": itemHeader,
        "budget-request-proper": budgetRequestProper,
        "liquidation-journal": liquidationJournal,
        "release-budget-request": releaseBudgetRequest,
        "disburse-budget-request": disburseBudgetRequest
    },
    mixins: [form],
    computed: {
        ...mapState("show-budget-request", {
            budget_request: (state) => state.item,
        }),
    },
    methods:{
        approveBudgetRequest(){
            this.$bvModal.show("approve-budget-request");
        }
    }
};
</script>
