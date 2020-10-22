<template>
	<div>
		<div class="row">
			<payment
				class="col-md-6"
				v-for="(payment, payment_index) in rfp.term_of_payments"
				:key="payment_index"
				:payment="payment"
				:namespace="namespace"
				:statuses="statuses"
			></payment>
		</div>

		<div class="row">
			<div class="col-md-12">
				<color-legend :statuses="statuses"></color-legend>
			</div>
		</div>
	</div>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
import payment from "./PreparationOfPayment/Payment";
import colorLegend from "./PreparationOfPayment/ColorLegend";

export default {
	data() {
		return {
			payments: ["Down Payment", "Full Payment"],
			statuses: [
				{
					name: "For Releasing",
					action: "Release",
					ability: 'release',
					color: "orange",
				},
				{
					name: "For Disbursement",
					action: "Disburse",
					ability: "disburse",
					color: "blue",
				},
				{
					name: "For Acknowledgement",
					action: "Acknowledge",
					ability: "acknowledge",
					color: "yellow",
				},
				{
					name: "Acknowledged",
					action: null,
					color: "green",
				},
			],
		};
	},
	props: {
		namespace: String,
	},
	components: {
		payment: payment,
		"color-legend": colorLegend,
	},
	computed: {
		...mapState({
			rfp(state){
				return state[this.namespace].item
			}
		})
	},
};
</script>