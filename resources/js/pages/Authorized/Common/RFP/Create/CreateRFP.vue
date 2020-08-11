<template>
	<div>
		<b-card class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">Create RFP</h1>
			</template>
			<b-card-body>
				<b-tabs fill content-class="mt-3">
					<b-tab title="RFP Profile" active>
						<!-- RFP Profile -->
						<rfp-profile></rfp-profile>
					</b-tab>
					<b-tab title="Bill Summary">
						<!-- Engeagement and Bill Summary -->
						<bill-summary></bill-summary>
					</b-tab>
					<b-tab title="Bill Verification" disabled>
						<!-- Bill Verification and Tax Validation -->
						<bill-verification></bill-verification>
					</b-tab>
					<b-tab title="Preparation of Payment" disabled>
						<!-- Preparation of Payment -->
						<preparation-of-payment></preparation-of-payment>
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
			</b-card-body>
			<template v-slot:footer>
				<b-button class="float-right" variant="outline-success" @click="createRFP">Create RFP</b-button>
			</template>
		</b-card>
	</div>
</template>

<script>
// Components
import rfpProfile from "./CreateRFP/RfpProfile";
import billSummary from "./CreateRFP/BillSummary";
import billVerification from "./CreateRFP/BillVerification";
import prearationOfPayment from "./CreateRFP/PreparationOfPayment";
import releaseOfPayment from "./CreateRFP/ReleaseOfPayment";
import liquidation from "./CreateRFP/Liquidation";

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
    computed: {
  
    },
    methods: {
        ...mapActions("create-rfp", {
			createRFP(dispatch){
				return dispatch("createRFP");
			}
		})
    },
};
</script>
