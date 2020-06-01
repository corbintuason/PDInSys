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

export default{
    data(){
        return{

        }
    },
    components:{
        "liq-journal-header": liqJournalHeader,
        "liq-journal-body": liqJournalBody
    },
}
</script>