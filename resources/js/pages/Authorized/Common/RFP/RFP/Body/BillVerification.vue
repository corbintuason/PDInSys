<template>
	<div>
		<label>{{term_of_payment_type}} Summary</label>
		<div class="row">
			<div class="col-md-12">
                <!-- Total Sales 
                FORMULA:
                If(vat_amount == 0) return 0
                else return VATABLE Sales + Vat Amount
                -->
				<b-form-group
					label="Total Sales (VAT Inclusive)"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
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
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- Total  
                 FORMULA:
                    Total Sales - Less Vat Amount
                 -->
				<b-form-group
					label="Total"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                <hr>

                 <!-- Total Due
                 FORMUlA: Equal to the Total
                  -->
                  
				<b-form-group
					label="Total Due"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- LESS: WIitholding TAX-->
				<b-form-group
					label="LESS: Witholding TAX"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- Amount Due -->
				<b-form-group
					label="Amount Due"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- ADD: VAT Amount -->
				<b-form-group
					label="ADD: VAT Amount"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- Total Amount Due -->
				<b-form-group
					label="Total Amount Due"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                <hr>
                 <!-- VATABLE Sales -->
				<b-form-group
					label="VATABLE Sales"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- VAT EXEMPT Sales -->
				<b-form-group
					label="VAT EXEMPT Sales"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- VAT ZERO RATED Sales -->
				<b-form-group
					label="VAT Zero Rated Sales"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- VAT Amount -->
				<b-form-group
					label="VAT Amount"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- Gross Amount -->
				<b-form-group
					label="Gross Amount"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- LESS: E-WHT -->
				<b-form-group
					label="LESS: E-WHT"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                 <!-- NET Amount -->
				<b-form-group
					label="NET Amount"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>

                <!-- Total NET -->
                <b-form-group
					label="Total NET"
					label-class="font-weight-bold"
					label-cols="3"
					class="col-md-6"
				>
					<b-input-group size="sm">
						<template v-slot:prepend>
							<b-input-group-text>
								<strong class="text-success">&#8369;</strong>
							</b-input-group-text>
						</template>
						<money class="form-control" disabled></money>
					</b-input-group>
				</b-form-group>
			</div>
		</div>
	</div>
</template>

<script>
import {mapState} from "vuex"

export default{
    data(){
        return{

        }
    },
    props:{
        namespace: String
    },
    computed:{
        ...mapState({
            rfp(state){
                return state[this.namespace].item
            }
        }),

        term_of_payment_type(){
            if(this.rfp.term_of_payment.percent >= 100){
                return "Full Payment"
            }else{
                return "Down Payment"
            }
        }
    }
}
</script>