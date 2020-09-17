<template>
	<div>
		<div class="row">
			<down-payment class="col-md-6" :namespace="namespace"></down-payment>
			<full-payment class="col-md-6" :namespace="namespace"></full-payment>
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
export default{
    data(){
        return{

        }
	},
	props:{
		namespace: String
	},
	components:{
		"down-payment": downPayment,
		"full-payment": fullPayment
	},
	computed:{
		...mapState({
			total_net(state, getters){
			return getters[this.namespace+"/total_net"];
			}
		})
	},

}


</script>