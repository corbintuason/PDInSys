<template>
	<!-- TODO: 
        -- Reject Notification for Vendor and Mandate
        -- Return Notification for Vendor and Mandate
        -- Return Method for Vendor and Mandate
        -- EWT DETAILS Update
	    -- Attachments files
	-->
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/mandates">List of mandates</b-breadcrumb-item>
			<b-breadcrumb-item active>PMID-{{mandate.code}}</b-breadcrumb-item>
		</b-breadcrumb>
		<div>
			<item-progress class="mt-3" v-if="mandate!=null" :steps="steps" :item="mandate" :mode="mode"></item-progress>
		</div>
		{{mandate.relationships}}
		<!-- Mandate -->
		<mandate-module
			v-if="mandate!=null"
			:mandate="mandate"
			:steps="steps"
			:mode="mode"
			:endpoints="endpoints"
			:key="show_mandate_key"
		></mandate-module>

		<!-- Change Logs -->
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
            endpoints:{
                api: "/api/mandate/",
                show_route: "mandate_show"
            },
            mandate: null,
            mandate_code: null
        } 
    },
    components: {
        "mandate-module": mandateModule,
        "change-logs": changeLogs,
    },
    methods: {
            getMandate() {
                var mandate_id = this.$route.params.id;
                axios.get("/api/mandate/" + mandate_id).then((response) => {
                    this.mandate = response.data.data;
                    this.mandate_code = response.data.meta.code;
                    this.change_logs = response.data.actions;
                    this.contributors = response.data.relationships.contributors
                    this.remarks = response.data.relationships.remarks
                    this.getCurrentStep();
                    this.fireToast();
                }).catch(e => {
                    console.log("dito palang mali na");
                });
            },
            getCurrentStep() {
                console.log(this.mandate);
                var status = this.mandate.status;
                var status_index = this.db_steps.indexOf(status) + 1;
                this.current_step = status_index;
            },
            updateMode(new_mode) {
                this.mode = new_mode;
            },
             switchMode(mode) {
                swal.fire({
                    title: mode + " Mode",
                    text: "Proceeding will grant you access to " + mode + " mode",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Proceed!",
                    onDestroy: () => {
                        this.fireToast();
                    },
                }).then((result) => {
                    if (result.value) {
                        this.mode = mode;
                        swal.fire(
                            mode + " Mode!",
                            "You are now in" + mode + " Mode.",
                            "success"
                        );
                    }
                });
            },
    },
    watch:{
    mode(){
      console.log("there have been changes");
      this.show_mandate_key++;
      console.log(this.show_mandate_key);
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

}
</script>

<style>
</style>