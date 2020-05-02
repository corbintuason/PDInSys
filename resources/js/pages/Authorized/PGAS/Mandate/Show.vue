<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/mandates">List of mandates</b-breadcrumb-item>
			<b-breadcrumb-item active>PMID-{{mandate_code}}</b-breadcrumb-item>
		</b-breadcrumb>
		<b-card v-if="mandate.status != 'Rejected'" class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">PMID-{{mandate_code}}</h1>
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
		<b-alert show v-else variant="danger" class="mt-3">
			This mandate has been
			<strong>Rejected</strong>
		</b-alert>

		<!-- Mandate -->
		<mandate-module
			v-if="mandate != null"
			:mandate_code="mandate_code"
			:user="user"
			:mandate="mandate"
			:mode="mode"
			:user_role="user_role"
			@update-mode="updateMode"
		></mandate-module>

		<!-- Change Logs -->
		<change-logs :logs="change_logs"></change-logs>
		{{mandate}}
	</div>
</template>

<script>
import mandateModule from "./Mandates";
import changeLogs from "../../../../components/public/ChangeLogs";
export default {
    data() {
        return {
            mode: "Show",
            user: this.$store.state.user,
            change_logs: null,
            user_role: null,
            mandate: null,
            mandate_code: null,

            front_steps: this.$store.state.globals.statuses.mandate.front_steps,
            db_steps: this.$store.state.globals.statuses.mandate.db_steps,
            current_step: null,
        } 
    },
    components: {
        "mandate-module": mandateModule,
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
            getMandate() {
                var mandate_id = this.$route.params.id;
                axios.get("/api/mandate/" + mandate_id).then((response) => {
                    this.mandate = response.data.data;
                    this.mandate_code = response.data.meta.code;
                    this.change_logs = response.data.actions;
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
    mounted() {
        // this.getUserRole();
        this.getMandate();
    },
}
</script>

<style>
</style>