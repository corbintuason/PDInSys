<template>
    <div>
        <create-mode :create_signed_ce_detail="create_signed_ce_detail" v-if="isSignedCENull" :detail="detail">
        </create-mode>
        <!-- <show-mode
            v-if="mode == 'Show'"
            :mode="mode"
            :detail="detail"
            :signed_ce_detail="detail.relationships.signed_ce_detail"
            :steps="steps"
        ></show-mode> -->
        <edit-mode
            v-else
            :detail="detail"
            :signed_ce_detail="detail.relationships.signed_ce_detail"
        ></edit-mode>
        <!-- <div class="row">
            <div class="col-md-12">
                <show-process-buttons
                    :mode="mode"
                    :item="signed_ce_detail"
                    :item_model="item_model"
                    :steps="steps"
                    :endpoints="endpoints"
                ></show-process-buttons>
            </div>
        </div> -->
    </div>
</template>

<script>
import createMode from "./SignedCE/CreateMode";
import editMode from "./SignedCE/EditMode";
import showProcessButtons from "../../../../../../components/authorized/public/ShowProcessButtons";
export default {
    data() {
        return {
            mode: "Show",
            item_model: "Signed Cost Estimate Detail",
            endpoints: {
                 api: "/api/signed_cost_estimate_detail/"
            }
        };
    },
    computed: {
        isSignedCENull(){
            return this.signed_ce_detail == null ? true: false;
        },
        signed_ce_detail(){
            return this.detail.relationships.signed_ce_detail;
        }
    },
    components: {
        "edit-mode": editMode,
        "create-mode": createMode,
        "show-process-buttons": showProcessButtons,
    },
    props: {
        detail: Object,
        steps: Array,
        create_signed_ce_detail: Object
    },
    mounted() {
        console.log(this.isSignedCENull, "??");
        // Fire.$on("switch-mode-"+this.signed_ce_detail.id, (mode) => {
        //     this.mode = mode;
        // });
    },
};
</script>
