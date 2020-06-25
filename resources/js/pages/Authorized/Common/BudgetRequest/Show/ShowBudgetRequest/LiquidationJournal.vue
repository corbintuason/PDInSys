<template>
<div>
    <!-- Liq. Journal Header -->
    <liq-journal-header></liq-journal-header>
    <liq-journal-body></liq-journal-body>

</div>
</template>

<script>
import liqJournalHeader from "./LiquidationJournal/LiqJournalHeader"
import liqJournalBody from "./LiquidationJournal/LiqJournalBody"
import {liquidationJournalModule} from "../../../../../../store/modules/liquidation-journal/show"
import {mapState} from "vuex"
export default{
    data(){
        return{
            namespace: "liquidation-journal"
        }
    },
    components:{
        "liq-journal-header": liqJournalHeader,
        "liq-journal-body": liqJournalBody
    },
    computed:{
        ...mapState("show-budget-request", {
            budget_request: state => state.item
        })
    },
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var namespace = "liquidation-journal";
        this.$store.registerModule(namespace, liquidationJournalModule);
    },
    mounted() {
        this.$store.dispatch(this.namespace+"/storeItem", this.budget_request.liquidation_journal);
    },
}
</script>