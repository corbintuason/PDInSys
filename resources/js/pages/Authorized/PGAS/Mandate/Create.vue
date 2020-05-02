<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/mandates">List of Manpower</b-breadcrumb-item>
			<b-breadcrumb-item active>Create Manpower</b-breadcrumb-item>
		</b-breadcrumb>
		<b-card class="mt-4">
			<template v-slot:header>
				<h1 class="component-title">Progress Bar</h1>
			</template>
			<b-card-text>
				<step-progress :steps="my_steps" icon-class="fa fa-check"></step-progress>
			</b-card-text>
		</b-card>
		<b-card class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">Project Based Info Sheet</h1>
			</template>

			<b-card-text>
				<b-tabs v-model="tabIndex" content-class="mt-3" fill>
					<b-tab title="General Info" active>
						<general-info :form="form"></general-info>
					</b-tab>
					<b-tab title="Government Details">
						<government-details :form="form"></government-details>
					</b-tab>
					<b-tab title="Education Attainment and Work Experience">
						<education-work :form="form"></education-work>
					</b-tab>
					<b-tab title="Other Information">
						<other-information :form="form"></other-information>
					</b-tab>
				</b-tabs>
			</b-card-text>
			<template v-slot:footer>
				<div class="row">
					<div class="col-md-6">
						<b-button-group class="mt-1">
							<b-button @click="tabIndex--">Previous Tab</b-button>
							<b-button @click="tabIndex++">Next Tab</b-button>
						</b-button-group>
					</div>
					<div class="col-md-6 text-right">
						<b-button
							:disabled="isDisabled"
							variant="success"
							class="float-right"
							@click="createMandate"
						>Create Mandate</b-button>
					</div>
				</div>
			</template>
		</b-card>
	</div>
</template>

<script>
import generalInfo from "./Create/GeneralInfo";
import governmentDetails from "./Create/GovernmentDetails";
import otherInformation from "./Create/OtherInformation";
import educationWork from "./Create/EducationWork";
export default {
	data() {
		return {
			user: this.$store.state.user,
			user_role: null,
			my_steps: ["Create", "Approve"],
			tabIndex: 0,
			mode: "Create",
			front_steps: this.$store.state.globals.statuses.mandate.front_steps,
			db_steps: this.$store.state.globals.statuses.mandate.db_steps,
			form: {
				date: "",
				position: "",
				full_name: {
					last_name: "",
					first_name: "",
					middle_name: ""
				},
				region: "",
				permanent_address: "",
				present_address: "",
				gender: "",
				civil_status: "",
				birthdate: "",
				age: "",
				mobile_number: "",
				telephone_number: "",
				religion: "",
				sss_number: "",
				tin_number: "",
				pagibig_number: "",
				philhealth_number: "",
				passport_number: "",
				tertiary_details: {
					tertiary_name: "",
					tertiary_date: ""
				},
				secondary_details: {
					secondary_name: "",
					secondary_date: ""
				},
				primary_details: {
					primary_name: "",
					primary_date: ""
				},
				work_details: [{
					work_position: "",
					job_description: "",
					start_date: "",
					end_date: ""
				}],
				father_details: {
					father_name: "",
					father_occupation: ""
				},
				mother_details: {
					mother_name: "",
					mother_occupation: ""
				},
				spouse_details: {
					spouse_name: "",
					spouse_occupation: ""
				},
				emergency_details: [{
					contact_person: "",
					contact_number: "",
				}],
				creator_id: this.$store.state.user.data.id,

			},
		};
	},
	components: {
		"general-info": generalInfo,
		"government-details": governmentDetails,
		"other-information": otherInformation,
		"education-work": educationWork,
	},
	computed:{
		isDisabled() {
			if (this.form.position == "" || this.form.full_name == "") {
				return true;
			}
			if (this.form.present_address == "" || this.form.permanent_address == "") {
				return true;
			}
			if (this.form.mobile_number == "" || this.form.telephone_number == "") {
				return true;
			}
			if (this.form.tin_number == "" || this.form.sss_number == "") {
				return true;
			}
			if (this.form.pagibig_number == "" || this.form.philhealth_number == "") {
				return true;
			}
		}
	},
	methods:{
		getUserRole(){
			this.user_role = this.user.data.module_access[0]["modules"][0]["features"][1]["role"];
		},
	   createMandate() {
			var contents = "";
            console.log(this.mandate);

            // // Load Contents first
            this.front_steps.forEach((step) => {
                if (step.name == "Create") {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        this.user.meta.full_name +
                        "</strong></span></div>";
                } else {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        "</strong></span></div>";
                }
            });
            var swal_html =
                '<span>Contribution List will be Updated</span><div class="list-group">' +
                contents +
                "</div> <span>Please check the details provided</span>";
		swal
			.fire({
			title: "Create Mandate",
			icon: "question",
			html: swal_html,
			confirmButtonText: "Create Mandate",
			text: "Please check the details provided.",
			showLoaderOnConfirm: true,
			preConfirm: () => {
				this.$Progress.start();
				return new Promise((resolve, reject) => {
				axios
					.post("/api/mandate", this.form)
						.then(response => {
						const user = response.data;
						resolve(user);
					})
					.catch(e => {
						this.$Progress.fail();
						swal.showValidationMessage(`Unable to create mandate`);
						swal.hideLoading();
						reject(e);
					});
				});
			}
			})
			.then(result => {
			if (result.value) {
				this.$Progress.finish();
				//(result);
				swal.fire({
				title: "Mandate Succesfully Created",
				icon: "success",
				timer: "2500",
				onClose: () => {
					this.$router.push({
						name: "mandate_show",
						params: { id: result.value.data.id },
					});
				}
				});
			}
		});
	}

  },
	// mounted(){
	// 	this.getUserRole();
	// }
};
</script>

<style></style>
