<template>
	<div>
		<div v-if="!loading">
			<!-- ITEM PROGRESS -->
			<item-progress :namespace="namespace"></item-progress>
			<!-- ACTUAL FORM -->
			<rfp-body :namespace="namespace"></rfp-body>

            <change-logs v-if="mode=='Show'" :namespace="namespace"></change-logs>
            {{mode}}
		</div>
		<clip-loader color="orange" v-else></clip-loader>
	</div>
</template>
 
<script>
import rfpBody from "./RFP/Body.vue";
import { mapState, mapActions } from "vuex";
export default {
    data() {
        return {};
    },
    computed: {
       ...mapState({
            type(state){
                return state[this.namespace].type
            },
            loading(state){
                return state[this.namespace].loading
            },
            mode(state){
                return state[this.namespace].mode
            }
        })
    },
    props:{
        namespace: String
    },
    components: {
        "rfp-body": rfpBody
    },
    methods: {
        ...mapActions({
            loadParentRequirement(dispatch) {
                var parent_id;
                if(this.type == 'Project'){
                    parent_id = this.$route.params.id;
                }else{
                    parent_id = 0;
                }
                return dispatch(this.namespace+"/loadParentRequirement", parent_id);
            },
        }),
    },
    mounted() {
        console.log("ggwp", this.namespace);
        console.log(this.$route.params.id +" ?");
        this.loadParentRequirement();
        console.log("so ano yung mode..", this.mode);
    },
};
</script>
