<template>
	<div>
		<div class="row">
			<!-- 
            Date of Engagement
            Description of Goods
            Bank Details
			-->
			<div class="col-md-6">
				<!-- Date of Engagement -->
				<div class="row">
					<b-form-group
						label="Date of Engagement"
						label-class="font-weight-bold"
						label-cols="5"
						class="col-md-6"
						description="From"
					>
						<b-datepicker
							v-model="rfp.start_date"
							:disabled="disableForm"
						></b-datepicker>
					</b-form-group>
					<b-form-group class="col-md-6" description="To">
						<b-datepicker
							v-model="rfp.end_date"
							:disabled="disableForm"
						></b-datepicker>
					</b-form-group>
				</div>

				<!-- Description of Goods -->
				<div class="row">
					<b-form-group
						label="Description of Goods / Service"
						label-class="font-weight-bold"
						class="col-md-12"
					>
						<b-form-textarea
							placeholder="Kindly itemize if possible..."
							rows="3"
							max-rows="6"
							:disabled="disableForm"
							v-model="rfp.description"
						></b-form-textarea>
					</b-form-group>
				</div>

				<!-- Bank Details -->
				<bank-details :namespace="namespace"></bank-details>
			</div>
			<!-- 
            Venue of Engagement - Bill / Quotation No.
            Down Payment: Term of Payment - Mode of Payment - Reqq Date of Release
            Full Payment: Term of Payment - Mode of Payment - Reqq Date of Release
            VAT Registration - Proof of Liquidation
			-->

			<div class="col-md-6">
				<!-- Venue of Engagement - Bill / Quotation No. -->
				<div class="row">
					<!-- Venue of Engagement -->
					<b-form-group
						label="Venue of Engagement:"
						label-class="font-weight-bold"
						class="col-md-6"
					>
						<b-input-group size="sm">
							<b-form-input
								v-model="rfp.venue"
								:disabled="disableForm"
							></b-form-input>
						</b-input-group>
					</b-form-group>

					<!-- Bill / Quotation No.  -->
					<b-form-group
						label="Bill / Quotation No:"
						label-class="font-weight-bold"
						class="col-md-6"
					>
						<b-input-group size="sm">
							<b-form-input
								v-model="rfp.quotation_no"
								:disabled="disableForm"
							></b-form-input>
						</b-input-group>
					</b-form-group>
				</div>

				<!-- Term of Payments -->
				<term-of-payments :namespace="namespace"></term-of-payments>

				<!-- VAT Registration - Proof  of Liquidation -->
				<div class="row">
					<!-- Vat Registration -->
					<b-form-group
						label="VAT Registration"
						label-class="font-weight-bold"
						class="col-md-6"
					>
						<b-input-group size="sm">
							<b-form-input
								disabled
								:value="vendor ? vendor.type_vat : ''"
							></b-form-input>
						</b-input-group>
					</b-form-group>

					<!-- Proof of Liquidation -->
					<b-form-group
						label="Proof of Liquidation"
						label-class="font-weight-bold"
						class="col-md-6"
					>
						<b-input-group size="sm">
							<b-form-input
								disabled
								:value="
									vendor ? vendor.proof_of_liquidation : ''
								"
							></b-form-input>
						</b-input-group>
					</b-form-group>
				</div>

				<!-- Billing Amount -->
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<billing-amount :namespace="namespace"></billing-amount>
			</div>
		</div>

		<!-- Upload Quotations -->
		<quotations v-if="mode=='Show'" :namespace="namespace"></quotations>
	</div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
import erfp from "../../../../../../mixins/erfp";
import formulas from "../../../../../../mixins/erfps/formulas";

import termOfPayments from "./BillSummary/TermOfPayments";
import bankDetails from "./BillSummary/BankDetails";
import quotations from "./BillSummary/Quotations";
import billingAmount from "./BillSummary/BillingAmount";
export default {
	data() {
		return {};
	},
	mixins: [erfp, formulas],
	props: {
		namespace: String,
	},
	components: {
		"term-of-payments": termOfPayments,
		"bank-details": bankDetails,
		quotations: quotations,
		"billing-amount": billingAmount,
	},

	watch: {
		down_payment_percent() {
			console.log("changing");
			if (this.down_payment_percent == 0) {
				this.rfp.term_of_payment.down_payment.mode_of_payment = null;
			} else {
				this.rfp.term_of_payment.down_payment.mode_of_payment =
					"Cash For Deposit";
			}
		},
	},
	computed: {
		...mapState({
			mode(state) {
				return state[this.namespace].mode;
			},
			rfp(state) {
				return state[this.namespace].item;
			},
			vendor(state) {
				return state[this.namespace].item.vendor;
			},
			loading(state) {
				return state[this.namespace].loading;
			},
			total_billing_amount(state, getters) {
				return getters[this.namespace + "/total_billing_amount"];
			},
			// total_net(state, getters){
			// return getters[this.namespace+"/total_net"];
			// }
		}),
	},

	methods: {},
};
</script>