<template>
	<div>
		<b-card class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">Create ERFP</h1>
			</template>
			<b-card-body>
				<b-tabs fill content-class="mt-3">
					<b-tab title="ERFP Profile" active>
						<!-- RFP Profile -->
						<rfp-profile :namespace="namespace"></rfp-profile>
					</b-tab>
					<b-tab title="Bill Summary" :disabled="rfp.vendor==null">
						<!-- Engeagement and Bill Summary -->
						<bill-summary :namespace="namespace" v-if="rfp.vendor!=null"></bill-summary>
					</b-tab>
					<b-tab title="Bill Verification" :disabled="rfp.vendor==null">
						<!-- Bill Verification and Tax Validation -->
						<bill-verification :namespace="namespace" v-if="rfp.vendor!=null"></bill-verification>
					</b-tab>
					<b-tab title="Preparation of Payment" :disabled="rfp.status=='For ERFP Approval'">
						<!-- Preparation of Payment -->
						<preparation-of-payment :namespace="namespace"></preparation-of-payment>
					</b-tab>
					<b-tab title="Release of Payment" disabled>
						<!-- Release of Payment -->
						<release-of-payment></release-of-payment>
					</b-tab>
					<b-tab title="Liquidation" disabled>
						<!-- Liquidation -->
						<liquidation></liquidation>
					</b-tab>
				</b-tabs>
				<!-- {{rfp}} -->
			</b-card-body>
			<template v-slot:footer>
				<b-button v-if="mode=='Create'" class="float-right" variant="outline-success" @click="createRFP">Create RFP</b-button>
				    <show-process-buttons
					v-else-if="mode=='Show'"
                    :namespace="namespace"
                ></show-process-buttons>
			</template>
		</b-card>
	</div>
</template>

<script>
// Components
import rfpProfile from "./Body/RfpProfile";
import billSummary from "./Body/BillSummary";
import billVerification from "./Body/BillVerification";
import prearationOfPayment from "./Body/PreparationOfPayment";
import releaseOfPayment from "./Body/ReleaseOfPayment";
import liquidation from "./Body/Liquidation";

// Mixins
import form from "../../../../../mixins/form";

// VueX
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";

// Export
export default {
    data() {
        return {};
    },
    components: {
        "rfp-profile": rfpProfile,
        "bill-summary": billSummary,
        "bill-verification": billVerification,
        "liquidation": liquidation,
        "release-of-payment": releaseOfPayment,
        "preparation-of-payment": prearationOfPayment
    },
	mixins: [form],
	props:{
		namespace: String
	},
    computed: {
		...mapState({
			mode(state){
				return state[this.namespace].mode;
			},
			rfp(state){
				return state[this.namespace].item;
			}
		})
    },
    methods: {
        ...mapActions({
			createRFP(dispatch){
				return dispatch(this.namespace+ "/createRFP");
			}
		})
    },
};
</script>
