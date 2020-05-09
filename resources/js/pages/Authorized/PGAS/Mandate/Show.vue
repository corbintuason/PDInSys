<template>
    <!-- TODO: 
        -- Reject Notification for Vendor and Mandate
        -- Return Notification for Vendor and Mandate
        -- Return Method for Vendor and Mandate
        -- EWT DETAILS Update
	    -- Attachments files
	-->
    <div v-if="mandate!=null">
        <b-breadcrumb class="mt-4" >
            <b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
            <b-breadcrumb-item href="/mandates"
                >List of mandates</b-breadcrumb-item
            >
            <b-breadcrumb-item active
                >PMID-{{ mandate.code }}</b-breadcrumb-item
            >
        </b-breadcrumb>
        <div v-if="mandate.status != 'Rejected'">
              <item-progress class="mt-3" :steps="steps" :item="mandate" :mode="mode"></item-progress>

        </div>
        <!-- <b-card v-if="mandate.status != 'Rejected'" class="mt-3">
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
                <template v-slot:footer>
				<div class="row  text-right">
                    <div class="col-md-12">

                    </div>
                </div>
			</template>
			</b-card-body>
		</b-card>-->
        <b-alert v-else show variant="danger" class="mt-3">
            This mandate has been
            <strong>Rejected</strong>
        </b-alert>

        <!-- Mandate -->
        <mandate-module
            v-if="mandate != null"
            :mandate_code="mandate.code"
            :user="user"
            :mandate="mandate"
            :mode="mode"
        ></mandate-module>

        <!-- Change Logs -->
        <change-logs :logs="mandate.relationships.actions"></change-logs>
    </div>
</template>

<script>
import mandateModule from "./Mandates";
import changeLogs from "../../../../components/public/ChangeLogs";
export default {
    data() {
        return {
            user: this.$store.state.user,
            mode: "Show",
            show_project_key: 0,
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
    watch: {},
    methods: {
        loadMandate() {
            var mandate_id = this.$route.params.id;
            axios.get("/api/mandate/" + mandate_id).then((response) => {
                this.mandate = response.data.data;
            });
        },
    },
    mounted() {
        // this.getUserRole();
        this.loadMandate();
    },
};
</script>

<style></style>
