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
            :signed_ce_detail="detail.relationships.signed_ce_detail"
            :steps="steps"
        ></edit-mode>
        <div class="row">
            <div class="col-md-12">
                <show-process-buttons
                    :mode="mode"
                    :item="signed_ce_detail"
                    :item_model="item_model"
                    :steps="steps"
                    :endpoints="endpoints"
                ></show-process-buttons>
            </div>
        </div>
    </div>
</template>

<script>
import showMode from "./SignedCE/ShowMode";
import editMode from "./SignedCE/EditMode";
import showProcessButtons from "../../../../../../components/authorized/public/ShowProcessButtons";
export default {
    data() {
        return {
            mode: "Show",
            item_model: "Signed Cost Estimate Detail",
            endpoints: {
                 api: "/api/signed_cost_estimate_detail/" + this.detail.relationships.signed_ce_detail.id,
            }
        };
    },
    computed: {
        signed_ce_detail(){
            return this.detail.relationships.signed_ce_detail;
        }
    },
    components: {
        "show-mode": showMode,
        "edit-mode": editMode,
        "show-process-buttons": showProcessButtons,
    },
    props: {
        detail: Object,
        steps: Array,
    },
    mounted() {
        Fire.$on("switch-mode-"+this.signed_ce_detail.id, (mode) => {
            this.mode = mode;
        });
    },
};
</script>
