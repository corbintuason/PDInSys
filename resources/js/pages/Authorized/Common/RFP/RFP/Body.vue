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
					<b-tab title="Bill Summary" :disabled="!show_bill_summary">
						<!-- Engeagement and Bill Summary -->
						<bill-summary :namespace="namespace" v-if="show_bill_summary"></bill-summary>
					</b-tab>
					<b-tab title="Bill Verification" :disabled="rfp.vendor==null">
						<!-- Bill Verification and Tax Validation -->
						<bill-verification :namespace="namespace" v-if="rfp.vendor!=null"></bill-verification>
					</b-tab>
					<b-tab title="Preparation of Payment" :disabled="!show_prep_payment">
						<!-- Preparation of Payment -->
						<preparation-of-payment v-if="show_prep_payment" :namespace="namespace"></preparation-of-payment>
					</b-tab>
					<b-tab title="Liquidation" :disabled="!show_liquidation">
						<!-- Liquidation -->
						<liquidation v-if="show_liquidation" :namespace="namespace"></liquidation>
					</b-tab>
				</b-tabs>
				<!-- {{rfp}} -->
			</b-card-body>
			<template v-slot:footer>
				<erfp-buttons :namespace="namespace"></erfp-buttons>
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

import erfpButtons from "./Body/ERFPButtons";

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
		"preparation-of-payment": prearationOfPayment,
		
		'erfp-buttons': erfpButtons

    },
	mixins: [form],
	props:{
		namespace: String
	},
    computed: {
		show_bill_summary(){
			// Requirements: Vendor is not null, erfpables' length is more than 1
			console.log("erfpables", this.rfp.erfpables);
			if(this.rfp.vendor == null || this.rfp.erfpables.length == 0){
				return false;
			} else return true;
		},
		show_prep_payment(){
			var valid_statuses = ['For Payment Processing', 'For Acknowledgement', 'For Closing', 'Closed'];
			if (valid_statuses.includes(this.rfp.status)){
				return true;
			}else return false;
		},
		show_liquidation(){
			if(this.rfp.status == 'For Closing' || this.rfp.status == 'Closed'){
				return true;
			} else return false;
		},
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
