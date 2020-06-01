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
                    <b-tab title="Liq. Journal">
                        <liquidation-journal></liquidation-journal>
                    </b-tab>
                </b-tabs>
    
            </b-card-body>
            <template v-slot:footer>
                <show-process-buttons
                    :namespace="namespace"
                ></show-process-buttons>
            </template>
        </b-card>
    </div>
</template>
<script>
import itemHeader from "../../../../../components/authorized/public/ItemHeader";
import budgetRequestProper from "./ShowBudgetRequest/BudgetRequestProper"
import form from "../../../../../mixins/form";
import liquidationJournal from "./ShowBudgetRequest/LiquidationJournal"
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
        "liquidation-journal": liquidationJournal

    },
    mixins: [form],
    computed: {
        ...mapState("show-budget-request", {
            budget_request: (state) => state.budget_request,
        }),
    },
};
</script>
