<template>
	<div>
		<!-- Down Payment -->
		<!-- Check Writing -->
		<check-write
			v-if="renderCheckWriting"
			:payment="payment"
			:namespace="namespace"
			:statuses="statuses"
		></check-write>
		<cash-checklist
			:payment="payment"
			:namespace="namespace"
			:statuses="statuses"
			v-else
		></cash-checklist>
	</div>
</template>

<script>
import cashCheckList from "./Payment/CashChecklist";
import checkWrite from "./Payment/CheckWrite";
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
export default {
	data() {
		return {

		};
	},
	props: {
		namespace: String,
		payment: Object,
		statuses: Array
	},
	components: {
		"cash-checklist": cashCheckList,
		"check-write": checkWrite,
	},
	computed: {
		...mapState({
			rfp(state) {
				return state[this.namespace].item;
			},
			term_of_payment(){
				console.log(this.payment, "? lah");
				if(this.payment.payment == 'Down Payment'){
					return this.rfp.term_of_payment.down_payment
				}else if (this.payment.payment == 'Full Payment'){
					return this.rfp.term_of_payment.full_payment
				}
			},
			renderCheckWriting() {
			if (this.term_of_payment.mode_of_payment == "Check") {
				return true;
			} else return false;
		},
		}),
	},
	methods: {
		
	},
};
</script>