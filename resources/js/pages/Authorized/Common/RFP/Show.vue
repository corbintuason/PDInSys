<template>
	<div>
		<rfp v-if="!loading" :namespace="namespace"></rfp>
	</div>
</template>

<script>
import RFP from "./RFP";
import { showRFPModule } from "../../../../store/modules/rfp/show";
import { mapState, mapActions } from "vuex";

export default {
    data() {
        return {
            namespace: "show-rfp",
        };
    },
    components: {
        "rfp": RFP
    },
    computed:{
        ...mapState("show-rfp",{
            loading: (state) => {
                return state.loading
            }
        })
    },
    methods:{
    
    },
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var namespace = "show-rfp";
        var rfp_id = this.$route.params.id;
        this.$store.registerModule(namespace, showRFPModule);
        this.$store.dispatch(namespace+"/storeItem", rfp_id, "Show");
        this.$store.commit(namespace+"/setMode", "Show");
    },
    mounted() {
        console.log(this.namespace, "namespace???");
    },
};
</script>
