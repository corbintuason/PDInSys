<template>
	<div>
		<b-button
			v-if="mode=='Create'"
            :disabled="disableCreate"
			class="float-right"
			variant="outline-success"
			@click="createRFP"
		>Create RFP</b-button>

		<show-process-buttons v-else-if="mode=='Show'" :namespace="namespace"></show-process-buttons>
	</div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
	data() {
		return {};
	},
	props: {
		namespace: String,
	},
	computed: {
		...mapState({
			mode(state) {
				return state[this.namespace].mode;
			},
			rfp(state) {
				return state[this.namespace].item;
			},
        }),
        disableCreate(){
            // List Required Fields
            /**
             * Vendor
             * At least 1 Budget Code / Project
             * Date of Engagement
             * Venue of Engagement
             * Quotation No
             * Description
             * Bank Index
             * Quotation
             */
            if(this.rfp.vendor == null){
                return true;
            }else return false;
        }
	},
	methods: {
		...mapActions({
			createRFP(dispatch) {
				return dispatch(this.namespace + "/createRFP");
			},
		}),
	},
};
</script>