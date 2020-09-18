<template>
	<div class="row">
	

		<b-form-group label="Bank Details" label-class="font-weight-bold" class="col-md-12">
				<b-form-select v-model="rfp.bank_index" class="mb-3" :disabled="disableForm">
			<b-form-select-option
				v-for="(bank, bank_index) in vendor.bank_details"
				:key="bank_index"
				:value="bank_index"
			>{{bank.bank_name}}</b-form-select-option>
		</b-form-select>
			<!-- Bank Index is NUll0 -->

			<b-alert show variant="danger" v-if="rfp.bank_index == null">Please select a bank</b-alert>

			<!-- Bank -->

			<!-- [{"bank_name":"BDO (Banco de Oro Universal Bank)","bank_address":[{"bank_branch":null,"bank_city":null}],"account_name":"qwe","account_number":"1"}] -->
			<template v-else>
				<b-input-group size="sm" prepend="Bank">
					<b-form-input disabled :value="vendor ? vendor.bank_details[rfp.bank_index].bank_name : ''"></b-form-input>
				</b-input-group>
				<!-- Bank Branch -->
				<b-input-group size="sm" prepend="Bank Branch">
					<b-form-input disabled :value="vendor ? vendor.bank_details[rfp.bank_index].bank_address.bank_branch : ''"></b-form-input>
				</b-input-group>
				<!-- Account Name -->
				<b-input-group size="sm" prepend="Account Name">
					<b-form-input disabled :value="vendor ? vendor.bank_details[rfp.bank_index].account_name : ''"></b-form-input>
				</b-input-group>
				<!-- Account No. -->
				<b-input-group size="sm" prepend="Account No.">
					<b-form-input disabled :value="vendor ? vendor.bank_details[rfp.bank_index].account_number : ''"></b-form-input>
				</b-input-group>
			</template>
		</b-form-group>
	</div>
</template>

<script>
import {mapState, mapActions, mapMutations, mapGetters} from "vuex"
import erfp from "../../../../../../../mixins/erfp"

export default{
    data(){
        return{
            bank_index: null,
			options:[],
        }
	},
	mixins:[erfp],
    props:{
        namespace: String
    },
    computed:{
        	...mapState({
				mode(state){
					return state[this.namespace].mode
				},
				rfp(state){
				return state[this.namespace].item
			},
			vendor(state){
				return state[this.namespace].item.vendor
			}
		}),
    },
}
</script>