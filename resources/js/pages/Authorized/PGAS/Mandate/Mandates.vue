<template>
	<div>
		<b-card class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">Mandate</h1>
			</template>
			<b-card-body v-if="mandate!=null">
				<b-card-text>
					<b-tabs v-model="tabIndex" content-class="mt-3" fill>
						<!-- Mandates Tab -->
						<b-tab title="General Info" active>
							<general-info :mode="mode" :mandate="mandate"></general-info>
						</b-tab>
						<b-tab title="Government Details">
							<government-details :mode="mode" :mandate="mandate"></government-details>
						</b-tab>
						<b-tab title="Education and Work">
							<education-work :mode="mode" :mandate="mandate"></education-work>
						</b-tab>
						<b-tab title="Other Information">
							<other-information :mode="mode" :mandate="mandate"></other-information>
						</b-tab>
					</b-tabs>
				</b-card-text>
			</b-card-body>
			<template v-slot:footer>
				<!-- For Approval Status -->
				<div class="row">
					<div class="col-md-6">
						<b-button-group class="mt-1">
							<b-button @click="tabIndex--">Previous Tab</b-button>
							<b-button @click="tabIndex++">Next Tab</b-button>
						</b-button-group>
					</div>
					<div class="col-md-6 text-right">
						<template v-if="mandate.status=='For Approval'">
							<!-- Return Mandate -->
							<b-button class="mr-1" variant="primary">Return Mandate</b-button>
							<!-- Reject Mandate -->
							<b-button
								v-if="user.roles=='mandate-approver' "
								variant="danger"
								class="mr-1 ml-1"
								@click="rejectMandate"
							>Reject Mandate</b-button>
							<b-button
								v-if="user.roles=='mandate-approver' "
								variant="success"
								class="ml-1"
								@click="approveMandate"
							>Approve Mandate</b-button>
						</template>
					</div>
				</div>
			</template>
		</b-card>
	</div>
</template>

<script>
import form from "../../../../mixins/form";
import educationWork from "./Show/EducationWork";
import generalInfo from "./Show/GeneralInfo";
import governmentDetails from "./Show/GovernmentDetails";
import otherInformation from "./Show/OtherInformation";

export default {
  data() {
    return {
        tabIndex: 0,
    };
  },
  mixins: [form],
  components: {
    "education-work": educationWork,
    "general-info": generalInfo,
    "government-details": governmentDetails,
    "other-information": otherInformation,
  },
  props: {
    user: Object,
    mandate: Object,
    mandate_code: String,
    mode: String,
    user_role: String
  },
  methods: {
    approveMandate() {
      // activate sweet alert
      const swal_object = {
        title: "Approve Mandate",
        icon: "question",
        confirmButtonText: "Are you sure?",
        text: "Mandate's status will be updated to Approved"
      };

      const axios_form = {
        api_link: "/api/mandate/" + this.mandate.id,
        status: "Approved",
      };

      this.updateItem(swal_object, axios_form);
    },
    rejectMandate(){
       // activate sweet alert
      const swal_object = {
        title: "Reject Mandate",
        icon: "warning",
        confirmButtonText: "Reject",
        text: "Mandate's status will be updated to Rejected"
      };

      const axios_form = {
        api_link: "/api/mandate/" + this.mandate.id,
        status: "Rejected",
      };

      this.updateItem(swal_object, axios_form);
    }
  },
  mounted() {
  }
};
</script>