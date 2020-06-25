<template>
    <b-modal size="xxl" id="liquidation-journal-form">
        <template v-slot:modal-title> Liquidation Journal Form </template>
        <div class="modal-body">
            <item-progress :namespace="namespace"></item-progress>
            <journal-proper></journal-proper>
            <journal-summary class="mt-5"></journal-summary>
        </div>
        <template v-slot:modal-footer>
            <!-- <show-process-buttons :namespace="namespace"></show-process-buttons> -->
            <journal-process-buttons></journal-process-buttons>
        </template>
    </b-modal>
</template>

<script>
import journalProper from "./LiquidationJournalForm/JournalProper";
import summary from "./LiquidationJournalForm/Summary";
import journalProcessButtons from "./LiquidationJournalForm/JournalProcessButtons"

export default {
    data() {
        return {
            namespace: "liquidation-journal",
        };
    },
    components: {
        "journal-proper": journalProper,
        "journal-summary": summary,
        "journal-process-buttons": journalProcessButtons
    },
};
</script>
