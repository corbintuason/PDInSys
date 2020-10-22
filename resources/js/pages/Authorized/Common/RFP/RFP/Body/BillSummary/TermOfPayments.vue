<template>
	<div>
		<!-- Down Payment: Term of Payment - Mode of Payment - Req Date of Release -->
		<div class="row">
			<!-- Term of Payment (Down Payment)-->
			<b-form-group
				label="Term of Payment:"
				label-class="font-weight-bold"
				class="col-md-4"
			>
				<b-input-group size="sm" prepend="Down Payment" append="%">
					<b-form-input
						type="number"
						v-model="rfp.term_of_payment.down_payment.percent"
						:disabled="disableForm"
						:min="0"
					></b-form-input>
				</b-input-group>
			</b-form-group>

			<!-- Bill / Quotation No.  -->
			<b-form-group
				:disabled="disableForm"
				label="Mode of Payment:"
				label-class="font-weight-bold"
				class="col-md-4"
			>
				<b-form-select
					size="sm"
					:style="
						mop_border(
							rfp.term_of_payment.down_payment.mode_of_payment
						)
					"
					v-model="rfp.term_of_payment.down_payment.mode_of_payment"
				>
					<b-form-select-option :value="null" :disabled="true">
						N/A
					</b-form-select-option>
					<b-form-select-option
						v-for="(down_payment_option,
						down_payment_option_index) in mode_of_payments"
						:key="down_payment_option_index"
						:disabled="down_payment_percent == 0"
						:value="down_payment_option.value"
					>
						{{ down_payment_option.text }}
					</b-form-select-option>
				</b-form-select>
			</b-form-group>

			<!-- Req. Date of Release  -->
			<b-form-group
				:disabled="disableForm"
				label="Req. Date of Release"
				label-class="font-weight-bold"
				class="col-md-4"
			>
				<b-datepicker
					size="sm"
					v-model="rfp.term_of_payment.down_payment.date_of_release"
					:disabled="disableForm"
				></b-datepicker>
			</b-form-group>
		</div>

		<!-- Full Payment: Term of Payment - Mode of Payment - Req Date of Release -->
		<div class="row">
			<!-- Term of Payment (Down Payment)-->
			<b-form-group
				label-class="font-weight-bold"
				disabled
				class="col-md-4"
			>
				<b-input-group size="sm" prepend="Full Payment" append="%">
					<b-form-input
						type="number"
						v-model="full_payment_percent"
						:disabled="disableForm"
					></b-form-input>
				</b-input-group>
			</b-form-group>

			<!-- Bill / Quotation No.  -->
			<b-form-group :disabled="disableForm" class="col-md-4">
				<b-form-select
					size="sm"
					:style="
						mop_border(
							rfp.term_of_payment.full_payment.mode_of_payment
						)
					"
					v-model="rfp.term_of_payment.full_payment.mode_of_payment"
				>
					<b-form-select-option :value="null" :disabled="true">
						N/A
					</b-form-select-option>
					<b-form-select-option
						v-for="(full_payment_option,
						full_payment_option_index) in mode_of_payments"
						:key="full_payment_option_index"
						:disabled="full_payment_percent == 0"
						:value="full_payment_option.value"
					>
						{{ full_payment_option.text }}
					</b-form-select-option>
				</b-form-select>
			</b-form-group>

			<!-- Req. Date of Release  -->
			<b-form-group :disabled="mode == 'Show'" class="col-md-4">
				<b-datepicker
					size="sm"
					v-model="rfp.term_of_payment.full_payment.date_of_release"
					:disabled="disableForm"
				></b-datepicker>
			</b-form-group>
		</div>
	</div>
</template>

<script>
import erfp from "../../../../../../../mixins/erfp";
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";

export default {
	data() {
		return {};
	},
	props: {
		namespace: String,
	},
	mixins: [erfp],
	watch: {
		down_payment_percent() {
			if (this.down_payment_percent > 0) {
				this.rfp.term_of_payment.down_payment.mode_of_payment =
					"Cash For Deposit";
			} else {
				this.rfp.term_of_payment.down_payment.mode_of_payment = null;
			}
		},
		// full_payment_percent(){
		//     if(this.full_payment_percent == null){
		//         this.rfp.term_of_payment.full_payment.percent = 0;
		//     }
		// }
	},
	computed: {
		...mapState({
			rfp(state) {
				return state[this.namespace].item;
			},
			mode(state) {
				return state[this.namespace].mode;
			},
			mode_of_payments(state, getters) {
				return getters[this.namespace + "/mode_of_payments"];
			},
		}),
		down_payment_percent() {
			return this.rfp.term_of_payment.down_payment.percent;
		},
		full_payment_percent() {
			return 100 - this.rfp.term_of_payment.down_payment.percent;
		},
	},
	methods: {
		mop_border(mop) {
			if (mop == null) {
				return "border-color:red";
			}
		},
	},
};
</script>