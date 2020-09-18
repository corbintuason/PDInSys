<template>
	<div>
		<div class="row">
			<b-input-group v-for ="(erfpable, erfpable_index) in rfp.erfpables" :key="erfpable_index" class="col-md-12 float-right">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="mr-4">Billing Amount ({{erfpable.item}}):</strong>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" :disabled="disableForm" v-model="erfpable.billing_amount"></money>
			</b-input-group>
            <hr>
            	<b-input-group class="col-md-12 float-right">
				<template v-slot:prepend>
					<b-input-group-text>
						<strong class="mr-4">Total Billing Amount:</strong>
						<strong class="text-success">&#8369;</strong>
					</b-input-group-text>
				</template>
				<money class="form-control" disabled :value="total_billing_amount"></money>
			</b-input-group>
		</div>
        <!-- {{rfp.erfpables}} -->
	</div>
</template>

<script>
import erfp from "../../../../../../../mixins/erfp";
import { mapState, mapActions, mapMutations, mapGetters } from "vuex";

export default {
	data() {
		return {};
	},
	mixins: [erfp],
	props: {
		namespace: String,
	},
	computed: {
		...mapState({
			rfp(state) {
				return state[this.namespace].item;
            },
		}),
	},
};
</script>