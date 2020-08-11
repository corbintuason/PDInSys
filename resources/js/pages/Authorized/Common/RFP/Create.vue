<template>
    <div>
        <div v-if="!loading">
            <!-- ITEM PROGRESS -->
            <item-progress namespace="create-rfp"></item-progress>
            <!-- ACTUAL FORM -->
            <create-rfp></create-rfp>
        </div>
        <clip-loader color="orange" v-else></clip-loader>
    </div>
</template>
 
<script>
import createRFP from "./Create/CreateRFP.vue";
import { mapState, mapActions } from "vuex";
export default {
    data() {
        return {};
    },
    computed: {
        ...mapState("create-rfp", {
            type: (state) => state.type,
            loading: state => state.loading
        }),
    },
    components: {
        "create-rfp": createRFP
    },
    methods: {
        ...mapActions("create-rfp", {
            loadParentRequirement(dispatch) {
                var parent_id;
                if(this.type == 'Project'){
                    parent_id = this.$route.params.id;
                }else{
                    parent_id = 0;
                }
                return dispatch("loadParentRequirement", parent_id);
            },
        }),
    },
    mounted() {
        console.log(
            "check the type asap",
            this.$store.state["create-rfp"].type
        );
        console.log("ggwp");0
        console.log(this.$route.params.id +" ?");
        this.loadParentRequirement();
    },
};
</script>
