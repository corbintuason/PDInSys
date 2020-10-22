<template>
	<b-card
		border-variant="primary"
		header-text-variant="white"
		header-class="font-weight-bold"
		header-bg-variant="primary"
	>
		<template v-slot:header>
			{{ payment.payment }}
		</template>
		<label>Check Write</label>
		<sub-processes :namespace="namespace"></sub-processes>

		<history-log :payment="payment"></history-log>

				<template v-slot:footer>
				<div class="proof-of-payment float-left">
					<!-- <strong>Proof Of Payment: </strong> <a href="#" @click.prevent="downloadPayment">{{file_name}}</a> -->
				</div>

				<b-button
					class="float-right"
					variant="outline-success"
					@click="processCheck"
					v-if="!disableForm"
					>{{ current_step.action }}</b-button
				>
			</template>

	</b-card>
</template>
<script>
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
import historyLog from "./HistoryLog";
import subProcesses from "./CheckWrite/SubProcesses"
export default {
	data() {
		return {
	
		};
	},
	props: {
		payment: String,
		namespace: String,
		statuses: Array,
	},
	components: {
		"history-log": historyLog,
		"sub-processes": subProcesses
	},
	computed: {
		...mapState({
			rfp(state) {
				return state[this.namespace].item;
			},
		}),
			disableForm() {
			if (!this.has_ability || this.rfp.status =='Closed') {
				return true;
			} else return false;
		},
				term_of_payment() {
				if (this.payment.payment == "Down Payment") {
					return this.rfp.term_of_payment.down_payment;
				} else {
					return this.rfp.term_of_payment.full_payment;
				}
			},
					current_step() {
				return this.statuses[
					this.statuses.findIndex(
						(status) => status.name == this.payment.status
					)
				];
			},
			next_step() {
				return this.statuses[
					this.statuses.findIndex(
						(status) => status.name == this.payment.status
					) + 1
				];
			},
	},
	methods: {
		renderCheckWriting(term_of_payment) {
			if (term_of_payment.mode_of_payment == "Check") {
				return true;
			} else return false;
		},
	},
};
</script>