<template>
  <div>
    <b-card class="mt-5">
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
      <template v-slot:footer>
        <b-button variant="success" class="float-right" @click="createMandate">Create Mandate</b-button>
      </template>
      {{ form }}
      <b-card-text>
        <b-tabs v-model="tabIndex" content-class="mt-3" fill>
          <b-tab title="General Info">
            <general-info :form="form"></general-info>
          </b-tab>
          <b-tab title="Government Details">
            <government-details></government-details>
          </b-tab>
          <b-tab title="Education Attainment and Work Experience">
            <education-work></education-work>
          </b-tab>
          <b-tab title="Other Information" active>
            <other-information></other-information>
          </b-tab>
        </b-tabs>
      </b-card-text>
    </b-card>
    <div class="row">
      <div class="col-md-12 text-center">
        <b-button-group class="mt-1">
          <b-button variant="primary" @click="tabIndex--">Previous</b-button>
          <b-button variant="primary" @click="tabIndex++">Next</b-button>
        </b-button-group>
      </div>
    </div>
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
			form: {
				creator_id: this.$store.state.user.data.id
			},
		};
	},
	components: {
		"general-info": generalInfo,
		"government-details": governmentDetails,
		"other-information": otherInformation,
		"education-work": educationWork,
	},
	methods:{
	// getUserRole(){
	//   this.user_role = this.user.data.module_access[0]["modules"][0]["features"][1]["role"];
	// },
	   createMandate() {
	  swal
		.fire({
		  title: "Create Mandate",
		  icon: "question",
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
				this.$router.push({ name : "mandate_index"});
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
