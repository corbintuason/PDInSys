<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/vendors">List of Vendors</b-breadcrumb-item>
			<b-breadcrumb-item active>VID-{{vendor_code}}</b-breadcrumb-item>
		</b-breadcrumb>
		<b-card v-if="vendor!=null" class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">VID-{{vendor_code}}</h1>
			</template>
			<b-card-body>
				<step-progress
					:steps="front_steps"
					:current-step="current_step"
					icon-class="fa fa-check"
					active-color="green"
					passive-color="gray"
				></step-progress>
				<br />
			</b-card-body>
		</b-card>
		<b-alert v-else show variant="danger" class="mt-3">
			This vendor has been
			<strong>Rejected</strong>
		</b-alert>

		<!-- Vendor -->
		<vendor-module
			v-if="vendor != null"
			:user="user"
			:vendor="vendor"
			:vendor_code="vendor_code"
			:mode="mode"
			:user_role="user_role"
			@update-mode="updateMode"
		></vendor-module>

		<!-- Change Logs -->
		<change-logs :logs="change_logs"></change-logs>
	</div>
</template>

<script>
import vendorModule from "./VendorAccreditation";
import changeLogs from "../../../../components/public/ChangeLogs";
export default {
    data() {
        return {
            mode: "Show",
            user: this.$store.state.user,
            change_logs: null,
            user_role: null,
            vendor: null,
            vendor_code: null,

            front_steps: this.$store.state.globals.statuses.vendor.front_steps,
            db_steps: this.$store.state.globals.statuses.vendor.db_steps,
            current_step: null,
        } 
    },
    components: {
        "vendor-module": vendorModule,
        "change-logs": changeLogs,
    },
    watch: {
        mode() {
            this.fireToast();
        },
    },
    methods: {
            getUserRole() {
                //("start");
                this.user_role = this.user.data.module_access[0]["modules"][0][
                    "features"
                ][1]["role"];
            },
            getVendor() {
                var vendor_id = this.$route.params.id;
                axios.get("/api/vendor/" + vendor_id).then((response) => {
                    this.vendor = response.data.data;
                    this.vendor_code = response.data.meta.code;
                    this.change_logs = response.data.actions;
                    this.getCurrentStep();
                    this.fireToast();
                }).catch(e => {
                    console.log("dito palang mali na");
                });
            },
            getCurrentStep() {
                console.log(this.vendor);
                var status = this.vendor.status;
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
    mounted() {
        // this.getUserRole();
        this.getVendor();
    },
}
</script>

<style>
</style>

		<!-- Import Item Progress Here:
				Props needed:
					- front_steps: Array from globals store vuex. Gawa ka muna ng array of statuses na nakikita sa progress bar (Create, Review, etc). See globals vuex for an example
					- db_steps: Array from globals store vuex. Gawa ka muna ng array of statuses na sinasave sa database (For Approval, For Review, etc.)
					- item: Prop na kinukuha mo sa axios. In this case yung makukuha mo sa axios.get("/api/vendor/{id}")
					- contributors: Create ka ng relationship table for vendors and contributors. A vendor hasMany contributors through sa contribution list. See Project Model and Project Contributor (I'll make this a polymorphic soon. for now, iapply mo nalang muna yung Vendor and VendorContributor relationship. Tignan mo nalang yung database structure ng project contributor, gayahin mo)
					- api_link: Hindi ko to inapply so ignore mo muna
					- remarks: May polymorphic relationship na ang remarks. Apply mo lang to sa Vendor Model mo:
							  public function remarks(){
								return $this->morphMany("App\Remark", 'remarkable')->with('returned_by');
							  }
					- mode: Use "Show" by default as a prop
					
		 -->

		 <!-- Import ShowProject Here 
		 		Props needed:
				 	- vendor: Vendor na makukuha mo sa api response callback
					- vendor_code: Add this sa Vendor model mo para magka code ka:
						  public function getCodeAttribute(){
							$year = date("y");
							return $year . "-".sprintf('%04d', $this->attributes['id']);
						}
						^^ Sample getter is for project. Change the code as needed depende sa format na binigay ni sir von sa Vendor Code
					- front_steps: As described earlier
					- contributors: As described earlier
		 -->