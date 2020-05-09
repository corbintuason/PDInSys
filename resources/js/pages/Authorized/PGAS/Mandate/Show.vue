<template>
	<!-- TODO: 
        -- Reject Notification for Vendor and Mandate
        -- Return Notification for Vendor and Mandate
        -- Return Method for Vendor and Mandate
        -- EWT DETAILS Update
	    -- Attachments files
	-->
	<div v-if="mandate!=null">
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/mandates">List of mandates</b-breadcrumb-item>
			<b-breadcrumb-item active>PMID-{{ mandate.code }}</b-breadcrumb-item>
		</b-breadcrumb>
		<div>
			<item-progress class="mt-3" v-if="mandate!=null" :steps="steps" :item="mandate" :mode="mode"></item-progress>
		</div>

		<!-- Mandate -->
		<mandate-module
			v-if="mandate != null"
			:mandate_code="mandate.code"
			:mandate="mandate"
			:mode="mode"
			:key="show_mandate_key"
		></mandate-module>

		<!-- Change Logs -->
		{{mandate.relationships}}
		<change-logs v-if="mandate!=null" :logs="mandate.relationships.actions"></change-logs>
	</div>
</template>

<script>
import mandateModule from "./Mandates";
import changeLogs from "../../../../components/public/ChangeLogs";
export default {
    data() {
        return {
            mode: "Show",
      	    show_mandate_key: 0,
            steps: this.$store.state.mandate.steps,
            endpoints: {
                api: "/api/mandate/",
                show_route: "mandate_show",
            },
            mandate: null,
        };
    },
    components: {
        "mandate-module": mandateModule,
        "change-logs": changeLogs,
    },
    watch:{
        mode(){
        this.show_mandate_key++;
        }
    },
    methods:{
        loadMandate(){
            var mandate_id = this.$route.params.id
            axios.get("/api/mandate/" + mandate_id).then(response => {
                this.mandate = response.data.data;
            })
        }
    },
    mounted(){
        this.loadMandate();

        Fire.$on('switch-mode', mode => {
            if(mode == 'Show'){
            this.loadMandate();
            }
            this.mode = mode;
        });
    },
};
</script>

<style></style>
