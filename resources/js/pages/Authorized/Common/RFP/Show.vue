<template>
	<div>
		<rfp v-if="!loading" :namespace="namespace"></rfp>
	</div>
</template>

<script>
import RFP from "./RFP";
import { createRFPModule } from "../../../../store/modules/rfp/create";
import { mapState, mapActions } from "vuex";

export default {
    data() {
        return {
            namespace: "create-rfp",
        };
    },
    components: {
        "rfp": RFP
    },
    computed:{
        ...mapState("create-rfp",{
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
        var namespace = "create-rfp";
        var rfp_id = this.$route.params.id;
        this.$store.registerModule(namespace, createRFPModule);
        this.$store.dispatch(namespace+"/setMode", "Show");
        this.$store.dispatch(namespace+"/storeItem", rfp_id, "Show");
    },
    mounted() {
        console.log(this.namespace, "namespace???");
    },
};
</script>
