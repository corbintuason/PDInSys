<template>
    <div>
        <rfp :namespace="namespace"></rfp>
    </div>
</template>

<script>
import createRFP from "./RFP";
import { createRFPModule } from "../../../../store/modules/rfp/create";
export default {
    data() {
        return {
            namespace: "create-rfp",
        };
    },
    components: {
        "rfp": createRFP
    },
    methods:{
    
    },
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var namespace = "create-rfp";
        this.$store.registerModule(namespace, createRFPModule);
        this.$store.commit(namespace+"/setType", "Project");
    },
    mounted() {
        console.log(this.namespace);
    },
};
</script>
