<template>
	<div v-if="vendor!=null">
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/vendors">List of Vendor</b-breadcrumb-item>
			<b-breadcrumb-item active>VID-{{ vendor.code }}</b-breadcrumb-item>
		</b-breadcrumb>
		<div>
			<item-progress class="mt-3" v-if="vendor!=null" :steps="steps" :item="vendor" :mode="mode"></item-progress>
		</div>

		<!-- Mandate -->
		<vendor-module
			v-if="vendor != null"
			:vendor_code="vendor.code"
			:endpoints="endpoints"
			:vendor="vendor"
			:mode="mode"
			:key="show_vendor_key"
			:steps="steps"
		></vendor-module>
		{{vendor.relationships}}
		<!-- Change Logs -->
		<change-logs v-if="vendor!=null" :logs="vendor.relationships.actions"></change-logs>
	</div>
</template>

<script>
import vendorModule from "./VendorAccreditation";
import changeLogs from "../../../../components/public/ChangeLogs";
export default {
    data() {
        return {
            mode: "Show",
      	    show_vendor_key: 0,
            steps: this.$store.state.vendor.steps,
            endpoints: {
                api: "/api/vendor/",
                show_route: "vendor_show",
            },
            vendor: null,
        };
    },
    components: {
        "vendor-module": vendorModule,
        "change-logs": changeLogs,
    },
    watch:{
        mode(){
        this.show_vendor_key++;
        }
    },
    methods:{
        loadVendor(){
            var vendor_id = this.$route.params.id
            axios.get("/api/vendor/" + vendor_id).then(response => {
                this.vendor = response.data.data;
            })
        }
    },
    mounted(){
        this.loadVendor();
        Fire.$on('switch-mode', mode => {
            if(mode == 'Show'){
            this.loadVendor();
            }
            this.mode = mode;
        });
    },
};
</script>

<style></style>
