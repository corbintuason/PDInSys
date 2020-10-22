<template>
	<div>
		<label>{{payment}} Summary </label>
	{{rfp.term_of_payment.down_payment}}
		<b-form-group
			label="Total Sales (VAT Inclusive)"
			label-class="font-weight-bold"
			label-cols="3">
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="total_sales(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- Less: Vat Amount
                 FORMULA:
                Always equal to Vat Amount
		-->

		<b-form-group
			label="LESS: VAT Amount"
			label-class="font-weight-bold"
			label-cols="3"
		>
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="vat_amount(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

	<!-- Less: Vat Amount
                 FORMULA:
                Always equal to Vat Amount
		-->

		<b-form-group
			label="LESS: Other Taxes"
			label-class="font-weight-bold"
			label-cols="3"
		>
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="other_taxes" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- Total  
                 FORMULA:
                    Total Sales - Less Vat Amount
		-->

		<b-form-group label="Total" label-class="font-weight-bold" label-cols="3">
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="total_due(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<hr />

		<!-- Total Due
                 FORMUlA: Equal to the Total
		-->

		<b-form-group label="Total Due" label-class="font-weight-bold" label-cols="3">
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="total_due(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- LESS: WIitholding TAX -->
		<b-form-group
			label="LESS: Witholding TAX"
			label-class="font-weight-bold"
			label-cols="3"
		>
			<b-form inline>
				<!-- First EWT Code of Vendor -->
				<b-form-group description="EWT Code 1">
					<b-input-group size="sm">
						<b-input disabled :value="vendor.ewt_details[0].name"></b-input>
					</b-input-group>
				</b-form-group>
				<!-- First EWT % of Vendor -->
				<b-form-group description="EWT % 1">
					<b-input-group size="sm">
						<b-input disabled :value="vendor.ewt_details[0].percent"></b-input>
					</b-input-group>
				</b-form-group>

				<!-- Override % -->
				<b-form-group description="Override %">
					<b-input-group size="sm">
						<b-input v-model="rfp.term_of_payment.down_payment.override"></b-input>
					</b-input-group>
				</b-form-group>

				<!--  Witholding TAX 
						=IF(vat_type="VAT Registered",
						value if vat registered:
						(IF(AD72="",(IFERROR((Z68*AB72),0)),(Z68*AD72))),
						value if not vat registered
						IF(AD72="",(IFERROR((Z88*AB72),0)),(Z88*AD72)))

						var used_percentage = total;
						var used_amount = total;

						if(may laman override){
							used_percentage = override;
						}
						if(vat_type != "Vat registered"){
							used_amount = gross_amount;
						}

						return used_amount*used_percentage
				-->
				<b-form-group description="Witholding TAX">
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" :value="witholding_tax(payment)" disabled></money>
					</b-input-group>
				</b-form-group>
			</b-form>
		</b-form-group>

		<!-- Amount Due
				FORMULA:
				if(vat registered){
					total due - witholding tax
				} else {
					0
				}
		-->
		<b-form-group label="Amount Due" label-class="font-weight-bold" label-cols="3">
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="amount_due(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- ADD: VAT Amount 
				FORMULA:
				equal to VAT Amount
		-->
		<b-form-group
			label="ADD: VAT Amount"
			label-class="font-weight-bold"
			label-cols="3"
		>
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="vat_amount(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- Total Amount Due
				FORMULA:
				Amount due + VAT Amount
		-->

		<b-form-group
			label="Total Amount Due"
			label-class="font-weight-bold"
			label-cols="3"
		>
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="total_amount_due(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<hr />
		<!-- VATABLE Sales
				FORMULA:
				if(vat registered){
					(Gross Amount - Vat Exempt Sales - Vat Zero Rated Sales)/1.12
				} else{
					0
				}
		-->
		<b-form-group
			label="VATABLE Sales"
			label-class="font-weight-bold"
			label-cols="3"
		>
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="vatable_sales(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- VAT EXEMPT Sales -->
		<b-form-group
			label="VAT EXEMPT Sales"
			label-class="font-weight-bold"
			label-cols="3"
		>
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<!-- <money v-model="rfp.term_of_payment.down_payment.vat_exempt_sales" class="form-control"></money> -->
				<money v-model="vat_exempt_sales" class="form-control"></money>

			</b-input-group>
		</b-form-group>

		<!-- VAT ZERO RATED Sales -->
		<b-form-group
			label="Other Taxes"
			label-class="font-weight-bold"
			label-cols="3"
		>
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money v-model="other_taxes" class="form-control"></money>
			</b-input-group>
		</b-form-group>

		

		<!-- VAT Amount 
				Formula:
				if(vat registered){
					vatable sales * 0.12
				} else {
					0
				}
		-->
		<b-form-group label="VAT Amount" label-class="font-weight-bold" label-cols="3">
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="vat_amount(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- Gross Amount 
				Formula
				Billing Amount - Down Payment Gross Amount
		-->
		<b-form-group label="Gross Amount" label-class="font-weight-bold" label-cols="3">
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="gross_amount(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- LESS: E-WHT 
				Formula: equal to witholding tax
		-->

		<b-form-group label="LESS: E-WHT" label-class="font-weight-bold" label-cols="3">
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="witholding_tax(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

		<!-- NET Amount
				Formula: Gross Amount - E-WHT
		-->

		<b-form-group label="NET Amount" label-class="font-weight-bold" label-cols="3">
			<b-input-group size="sm">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :value="net_amount(payment)" disabled></money>
			</b-input-group>
		</b-form-group>

	</div>
</template>

<script>
import {mapState} from "vuex"
import formulas from "../../../../../../../mixins/erfps/formulas";
export default{
    data(){
        return{

        }
	},
	mixins:[formulas],
    props:{
	namespace: String,
	payment: String
    },
    computed:{
		vat_exempt_sales:{
			get(){
				if(this.payment == 'Full Payment')
					return this.rfp.term_of_payment.full_payment.vat_exempt_sales;
				else if (this.payment == 'Down Payment')
					return this.rfp.term_of_payment.down_payment.vat_exempt_sales;
			},
			set(val){
				if(this.payment == 'Full Payment')
					this.rfp.term_of_payment.full_payment.vat_exempt_sales = val;
				else if (this.payment == 'Down Payment')
					this.rfp.term_of_payment.down_payment.vat_exempt_sales = val;
			}
		},
		other_taxes:{
			get(){
				if(this.payment == 'Full Payment')
					return this.rfp.term_of_payment.full_payment.other_taxes;
				else if (this.payment == 'Down Payment')
					return this.rfp.term_of_payment.down_payment.other_taxes;
			},
			set(val){
				if(this.payment == 'Full Payment')
					this.rfp.term_of_payment.full_payment.other_taxes = val;
				else if (this.payment == 'Down Payment')
					this.rfp.term_of_payment.down_payment.other_taxes = val;
			}
		},
		
        ...mapState({
            rfp(state){
                return state[this.namespace].item
			},
			vendor(state){
				return state[this.namespace].item.vendor
			},
				total_billing_amount(state, getters) {
				return getters[this.namespace + "/total_billing_amount"];
			},
		}),
	},
	mounted(){
	}
}
</script>