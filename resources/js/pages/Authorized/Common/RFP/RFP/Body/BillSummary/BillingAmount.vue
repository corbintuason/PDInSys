<template>
	<b-card
		border-variant="primary"
		header-text-variant="white"
		header-class="font-weight-bold"
		header-bg-variant="primary"
	>
		<template v-slot:header>
			Billing Amount
		</template>
		<div class="row">
			<table class="table table-sm table-bordered text-center">
				<tbody>
					<tr
						v-for="(erfpable, erfpable_index) in rfp.erfpables"
						:key="erfpable_index"
					>
						<td> {{erfpableItem(erfpable)}}</td>
						<th>
							<b-input-group>
								<template v-slot:prepend>
									<b-input-group-text>
										<strong class="text-success"
											>&#8369;</strong
										>
									</b-input-group-text>
								</template>
								<money
									class="form-control"
									:disabled="disableForm"
									v-model="erfpable.billing_amount"
								></money>
								<template v-slot:append>
									<process-erfpable-buttons
										v-if="mode != 'Create'"
										:erfpable="erfpable"
										:namespace="namespace"
									></process-erfpable-buttons>
								</template>
							</b-input-group>
						</th>
					</tr>
					<tr>
						<th>TOTAL BILLING AMOUNT</th>
						<th>
							<b-input-group>
								<template v-slot:prepend>
									<b-input-group-text>
										<strong class="text-success"
											>&#8369;</strong
										>
									</b-input-group-text>
								</template>
								<money
									class="form-control"
									disabled
									:value="total_billing_amount"
								></money>
							</b-input-group>
						</th>
					</tr>
					<tr>
						<th>TOTAL NET</th>
						<th>
							<b-input-group>
								<template v-slot:prepend>
									<b-input-group-text>
										<strong class="text-success"
											>&#8369;</strong
										>
									</b-input-group-text>
								</template>
								<money
									class="form-control"
									disabled
									:value="total_net"
								></money>
							</b-input-group>
						</th>
					</tr>
				</tbody>
			</table>
		</div>
	</b-card>
</template>

<script>
import erfp from "../../../../../../../mixins/erfp";
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";
import formulas from "../../../../../../../mixins/erfps/formulas";
import processERFPableButtons from "./BillingAmount/ProcessERFPableButtons";

export default {
	data() {
		return {};
	},
	mixins: [erfp, formulas],
	props: {
		namespace: String,
	},
	components: {
		"process-erfpable-buttons": processERFPableButtons,
	},
	computed: {
		...mapState({
			rfp(state) {
				return state[this.namespace].item;
			},
			mode(state) {
				return state[this.namespace].mode;
			},
			total_billing_amount(state, getters) {
				return getters[this.namespace + "/total_billing_amount"];
			},
		}),
		      total_net() {
				  console.log("Net amount of Down Payment", this.net_amount('Down Payment'));
				  console.log("Net amount of full payment", this.net_amount("Full Payment"));
            return this.net_amount("Down Payment") + this.net_amount("Full Payment")
        },
	},
	methods:{
		erfpableItem(erfpable){
			if(this.mode == 'Create'){
				return erfpable.item;
			}else {
				return erfpable.erfpable.name;
			}
		}
	},
	mounted() {
		console.log(this.mode, "MODE");
	},
};
</script>