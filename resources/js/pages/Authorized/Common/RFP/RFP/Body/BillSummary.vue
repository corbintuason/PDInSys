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
						<b-datepicker v-model="rfp.start_date" 						:disabled='mode=="Show"'
></b-datepicker>
					</b-form-group>
					<b-form-group class="col-md-6" description="To">
						<b-datepicker v-model="rfp.end_date" 						:disabled='mode=="Show"'
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
													:disabled='mode=="Show"'

							v-model="rfp.description"
						></b-form-textarea>
					</b-form-group>
				</div>

				<!-- Bank Details -->
				<div class="row">
					<b-form-group label="Bank Details" label-class="font-weight-bold" class="col-md-12">
						<!-- Bank -->

						<!-- [{"bank_name":"BDO (Banco de Oro Universal Bank)","bank_address":[{"bank_branch":null,"bank_city":null}],"account_name":"qwe","account_number":"1"}] -->
						<b-input-group size="sm" prepend="Bank">
							<b-form-input
								disabled
								:value="vendor ? vendor.bank_details[0].bank_name : ''"
							></b-form-input>
						</b-input-group>
						<!-- Bank Branch -->
						<b-input-group size="sm" prepend="Bank Branch">
							<b-form-input
								disabled
								:value="vendor ? vendor.bank_details[0].bank_address[0].bank_branch : ''"
							></b-form-input>
						</b-input-group>
						<!-- Account Name -->
						<b-input-group size="sm" prepend="Account Name">
							<b-form-input
								disabled
								:value="vendor ? vendor.bank_details[0].account_name : ''"
							></b-form-input>
						</b-input-group>
						<!-- Account No. -->
						<b-input-group size="sm" prepend="Account No.">
							<b-form-input
								disabled
								:value="vendor ? vendor.bank_details[0].account_number : ''"
							></b-form-input>
						</b-input-group>
					</b-form-group>
				</div>
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
							<b-form-input v-model="rfp.venue" 						:disabled='mode=="Show"'
></b-form-input>
						</b-input-group>
					</b-form-group>

					<!-- Bill / Quotation No.  -->
					<b-form-group label="Bill / Quotation No:" label-class="font-weight-bold" class="col-md-6">
						<b-input-group size="sm">
							<b-form-input v-model="rfp.quotation_no" 						:disabled='mode=="Show"'
></b-form-input>
						</b-input-group>
					</b-form-group>
				</div>

				<!-- Down Payment: Term of Payment - Mode of Payment - Req Date of Release -->
				<div class="row">
					<!-- Term of Payment (Down Payment)-->
					<b-form-group
 label="Term of Payment:" label-class="font-weight-bold" class="col-md-4">
						<b-input-group size="sm" :prepend="string_equivalent" append="%">
							<b-form-input type="number" v-model="rfp.term_of_payment.percent" :disabled="mode=='Show'"></b-form-input>
						</b-input-group>
					</b-form-group>

					<!-- Bill / Quotation No.  -->
					<b-form-group 						:disabled='mode=="Show"'
 label="Bill / Quotation No:" label-class="font-weight-bold" class="col-md-4">
						<b-input-group size="sm">
							<b-form-input v-model="rfp.term_of_payment.quotation_no"></b-form-input>
						</b-input-group>
					</b-form-group>

					<!-- Req. Date of Release  -->
					<b-form-group 						:disabled='mode=="Show"'
 label="Req. Date of Release" label-class="font-weight-bold" class="col-md-4">
						<b-datepicker size="sm" v-model="rfp.term_of_payment.date_of_release" :disabled='mode=="Show"'></b-datepicker>
					</b-form-group>
				</div>
				<!-- VAT Registration - Proof of Liquidation -->
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
							<b-form-input disabled></b-form-input>
						</b-input-group>
					</b-form-group>
				</div>

				<!-- Billing Amount -->
				<div class="row">
					<div class="col-md-12 float-right">
						<b-input-group 						
>
							<template v-slot:prepend>
								<b-input-group-text
                                    >
									<strong class="mr-4">
										Billing Amount:
									</strong>
									<strong class="text-success"
                                        >  &#8369;</strong
                                    ></b-input-group-text>
							</template>
							<money class="form-control" :disabled='mode=="Show"' v-model="rfp.billing_amount"></money>
						</b-input-group>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import {mapState, mapActions, mapMutations, mapGetters} from "vuex"
export default{
	data(){
		return{
			
		}
	},
	props:{
		namespace: String
	},
	computed:{
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
            }
		}),
		
		string_equivalent(){
			if(this.rfp.term_of_payment.percent >= 100){
				return "Full Payment"		
			}else{
				return "Down Payment"
			}
		}
	}
}
</script>