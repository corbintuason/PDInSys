<template>
	<div>
		<div class="row">
			<payment v-for="(payment, payment_index) in payments" :key="payment_index" :namespace="namespace" :payment="payment" class="col-md-6"></payment>
			<!-- <down-payment class="col-md-6" :namespace="namespace"></down-payment>
			<full-payment class="col-md-6" :namespace="namespace"></full-payment> -->
	<hr>
			<!-- Total NET -->
			  <b-card bg-variant="success" text-variant="white" class="col-md-4 offset-md-8">
           <strong>Total NET: </strong>      <b-input-group>
                <template v-slot:prepend>
                    <b-input-group-text
                        ><strong class="text-success"
                            >&#8369;</strong
                        ></b-input-group-text
                    >
                </template>
					<money class="form-control" :value="total_net" disabled></money>
            </b-input-group>
        </b-card>
			<!-- Multiple PDFs are required
			"Kindly attach quotation"
			- Add Net Amount below Billing Amount
			Change Approve to RFP Approve

			Validator - Disburser can edit

			RFP ppl are the same as BR ppl

			-->
		</div>
	</div>
</template>

<script>
import {mapState} from "vuex"
import downPayment from "./BillVerification/DownPayment"
import fullPayment from "./BillVerification/FullPayment"
import payment from "./BillVerification/Payment"
import formulas from "../../../../../../mixins/erfps/formulas";
export default{
    data(){
        return{
			payments:["Down Payment", "Full Payment"]
        }
	},
	mixins:[formulas],
	props:{
		namespace: String
	},
	components:{
		"down-payment": downPayment,
		"full-payment": fullPayment,
		"payment": payment
	},
	computed:{
		...mapState({
			rfp(state){
				return state[this.namespace].item
			}
		})
	},

}


</script>