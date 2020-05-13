<template>
    <div>
        <show-mode
            v-if="mode == 'Show'"
            :mode="mode"
            :detail="detail"
            :signed_ce_detail="detail.relationships.signed_ce_detail"
            :steps="steps"
        ></show-mode>
        <edit-mode
            v-else-if="mode == 'Edit'"
            :detail="detail"
            :mode="mode"
            :steps="steps"
        ></edit-mode>
        <div class="row" v-if="forProcessing">
            <div class="col-md-12">
                <show-process-buttons
                    :mode="mode"
                    :item="detail"
                    :item_model="item_model"
                    :steps="steps"
                    :endpoints="endpoints"
                    :uploadable="true"
                ></show-process-buttons>
            </div>
        </div>
        <div v-else>
            <process-signing :detail="detail"></process-signing>
        </div>
    </div>
</template>

<script>
import showMode from "./UnsignedCE/ShowMode";
import editMode from "./UnsignedCE/EditMode";
import processSigning from "./UnsignedCE/ProcessSigning";
import showProcessButtons from "../../../../../../components/authorized/public/ShowProcessButtons";
export default {
    data() {
        return {
            mode: "Show",
            item_model: "Cost Estimate Detail",
            endpoints: {
                api: "/api/cost_estimate_detail/" + this.detail.id,
            },
        };
    },
    computed: {
        forProcessing() {
            return this.detail.status != "Cleared";
        },
    },
    components: {
        "show-mode": showMode,
        "edit-mode": editMode,
        "show-process-buttons": showProcessButtons,
        "process-signing": processSigning
    },
    props: {
        detail: Object,
        steps: Array,
    },
    mounted() {
        Fire.$on("switch-mode-" + this.detail.id, (mode) => {
            this.mode = mode;
        });
    },
};
</script>
