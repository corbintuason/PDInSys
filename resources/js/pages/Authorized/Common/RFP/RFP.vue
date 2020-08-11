<template>
    <div>
        <create-rfp :namespace="namespace"></create-rfp>
    </div>
</template>

<script>
import createRFP from "./Create";
import { createRFPModule } from "../../../../store/modules/rfp/create";
export default {
    data() {
        return {
            namespace: "create-rfp",
        };
    },
    components: {
        "create-rfp": createRFP
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
