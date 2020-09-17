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
						<b-datepicker v-model="rfp.start_date" :disabled="disableForm"></b-datepicker>
					</b-form-group>
					<b-form-group class="col-md-6" description="To">
						<b-datepicker v-model="rfp.end_date" :disabled="disableForm"></b-datepicker>
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
					<b-form-group label="Venue of Engagement:" label-class="font-weight-bold" class="col-md-6">
						<b-input-group size="sm">
							<b-form-input v-model="rfp.venue" :disabled="disableForm"></b-form-input>
						</b-input-group>
					</b-form-group>

					<!-- Bill / Quotation No.  -->
					<b-form-group label="Bill / Quotation No:" label-class="font-weight-bold" class="col-md-6">
						<b-input-group size="sm">
							<b-form-input v-model="rfp.quotation_no" :disabled="disableForm"></b-form-input>
						</b-input-group>
					</b-form-group>
				</div>

				<!-- Down Payment: Term of Payment - Mode of Payment - Req Date of Release -->
				<div class="row">
					<!-- Term of Payment (Down Payment)-->
					<b-form-group label="Term of Payment:" label-class="font-weight-bold" class="col-md-4">
						<b-input-group size="sm" prepend="Down Payment" append="%">
							<b-form-input type="number" v-model="rfp.term_of_payment.down_payment.percent" :disabled="disableForm" :min="0"></b-form-input>
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
							:style="mop_border(rfp.term_of_payment.down_payment.mode_of_payment)"
							size="sm"
							v-model="rfp.term_of_payment.down_payment.mode_of_payment"
							:options="mode_of_payments"
						></b-form-select>
					</b-form-group>

					<!-- Req. Date of Release  -->
					<b-form-group
						:disabled="disableForm"
						label="Req. Date of Release"
						label-class="font-weight-bold"
						class="col-md-4"
					>
						<b-datepicker size="sm" v-model="rfp.term_of_payment.down_payment.date_of_release" :disabled="disableForm"></b-datepicker>
					</b-form-group>
				</div>

				<!-- Full Payment: Term of Payment - Mode of Payment - Req Date of Release -->
				<div class="row">
					<!-- Term of Payment (Down Payment)-->
					<b-form-group label-class="font-weight-bold" disabled class="col-md-4">
						<b-input-group size="sm"  prepend="Full Payment" append="%">
							<b-form-input type="number" v-model="full_payment_percent" :disabled="disableForm"></b-form-input>
						</b-input-group>
					</b-form-group>

					<!-- Bill / Quotation No.  -->
					<b-form-group
						:disabled="disableForm"
						class="col-md-4"
					>
						<b-form-select
							size="sm"
														:style="mop_border(rfp.term_of_payment.full_payment.mode_of_payment)"

							v-model="rfp.term_of_payment.full_payment.mode_of_payment"
							:options="mode_of_payments"
						></b-form-select>
					</b-form-group>

					<!-- Req. Date of Release  -->
					<b-form-group
						:disabled="mode=='Show'"
						class="col-md-4"
					>
						<b-datepicker size="sm" v-model="rfp.term_of_payment.full_payment.date_of_release" :disabled="disableForm"></b-datepicker>
					</b-form-group>
				</div>
				<!-- VAT Registration - Proof  of Liquidation -->
				<div class="row">
					<!-- Vat Registration -->
					<b-form-group label="VAT Registration" label-class="font-weight-bold" class="col-md-6">
						<b-input-group size="sm">
							<b-form-input disabled :value="vendor ? vendor.type_vat : ''"></b-form-input>
						</b-input-group>
					</b-form-group>

					<!-- Proof of Liquidation -->
					<b-form-group label="Proof of Liquidation" label-class="font-weight-bold" class="col-md-6">
						<b-input-group size="sm">
							<b-form-input disabled :value="vendor ? vendor.proof_of_liquidation :''"></b-form-input>
						</b-input-group>
					</b-form-group>
				</div>

				<!-- Billing Amount -->
				<div class="row">
					<div class="col-md-12 float-right">
						<b-input-group>
							<template v-slot:prepend>
								<b-input-group-text>
									<strong class="mr-4">Billing Amount:</strong>
									<strong class="text-success">&#8369;</strong>
								</b-input-group-text>
							</template>
							<money class="form-control" :disabled="disableForm" v-model="rfp.billing_amount"></money>
						</b-input-group>
					</div>
				</div>

					<!-- Billing Amount -->
				<div class="row">
					<div class="col-md-12 float-right">
						<b-input-group>
							<template v-slot:prepend>
								<b-input-group-text>
									<strong class="mr-4">TOTAL NET:</strong>
									<strong class="text-success">&#8369;</strong>
								</b-input-group-text>
							</template>
					<money class="form-control" :value="total_net" disabled></money>
						</b-input-group>
					</div>
				</div>
			</div>
		</div>

		<!-- Upload Quotations -->
		<quotations :namespace="namespace"></quotations>
	</div>
</template>

<script>
import {mapState, mapActions, mapMutations, mapGetters} from "vuex"
import erfp from "../../../../../../mixins/erfp"

import bankDetails from "./BillSummary/BankDetails"
import quotations from "./BillSummary/Quotations"
export default{
	data(){
		return{
		}
	},
	mixins:[erfp],
	props:{
		namespace: String
	},
	components:{
		"bank-details": bankDetails,
		"quotations": quotations
	},

	watch:{
		down_payment_percent(){
			console.log("changing");
			if(this.down_payment_percent == 0){
			this.rfp.term_of_payment.down_payment.mode_of_payment = null;
			}else{
			this.rfp.term_of_payment.down_payment.mode_of_payment = "Cash For Deposit";
			}
		}
	},
	computed:{
		down_payment_percent(){
			return this.rfp.term_of_payment.down_payment.percent;
		},
		full_payment_percent(){
			return 100 - this.rfp.term_of_payment.down_payment.percent;
		},
		//    ...mapState("create-rfp", {
        //     selected_vendor: (state) => state.selected_vendor,
        //     rfp: state => state.item
		// }),
				...mapState({
            mode(state){
                return state[this.namespace].mode
			},
			rfp(state){
				return state[this.namespace].item
			},
			vendor(state){
				return state[this.namespace].item.vendor
			},
            loading(state){
                return state[this.namespace].loading
			},
			mode_of_payments(state, getters){
				return getters[this.namespace+"/mode_of_payments"]
			},
			total_net(state, getters){
			return getters[this.namespace+"/total_net"];
			}
		}),
	},

	methods:{
		mop_border(mop){
			if(mop == null){
				return "border-color:red"
			}

		}
	}
}
</script>