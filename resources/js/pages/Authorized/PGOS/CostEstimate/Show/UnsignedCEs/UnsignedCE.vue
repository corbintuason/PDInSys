<template>
    <div>
        <show-mode
            v-if="mode == 'Show'"
            :mode="mode"
            :detail="detail"
            :signed_ce_detail="detail.signed_ce_detail"
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
                    :namespace="namespace"
                ></show-process-buttons>
            </div>
        </div>
        <div v-else>
            <process-signing :mode="mode" :detail="detail"></process-signing>
        </div>
    </div>
</template>

<script>
import showMode from "./UnsignedCE/ShowMode";
import editMode from "./UnsignedCE/EditMode";
import processSigning from "./UnsignedCE/ProcessSigning";
import showProcessButtons from "../../../../../../components/authorized/public/ShowProcessButtons";
import {mapState} from "vuex";
import { unsignedCostEstimateDetailModule } from "../../../../../../store/modules/unsigned-cost-estimate-detail";
export default {
    data() {
        return {
            namespace: "unsigned-cost-estimate-detail-" + this.detail.id,
            mode: "Show"
        };
    },
    computed: {
        ...mapState("auth", {
            user: state => state.user
        }),
        forProcessing() {
            return this.detail.status != "Cleared";
        },
    },
    components: {
        "show-mode": showMode,
        "edit-mode": editMode,
        "show-process-buttons": showProcessButtons,
        "process-signing": processSigning,
    },
    props: {
        detail: Object,
        steps: Array,
    },
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {},
    created() {
        var namespace = "unsigned-cost-estimate-detail-" + this.detail.id;
        this.$store.registerModule(namespace, unsignedCostEstimateDetailModule);

        this.$store.commit(namespace + "/storeItem", this.detail);
   
        console.log("namespace po", this.namespace);
    },
    mounted(){
        console.log(this.user)
        console.log("dtail", this.detail);
    }
};
</script>
