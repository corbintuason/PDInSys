<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Add User</h1>
      </template>
      <b-card-text>
        <b-tabs content-class="mt-3" fill>
          <b-tab title="User Details">
            <!-- PERSONAL INFORMATION -->
            <div id="personal_information">
              <h1 class="component-sub-header">Personal Information</h1>

              <div class="row">
                <div class="col-md-4 mt-3" style="text-align:center">
                  <!-- If there is no image uploaded -->
                  <div
                    v-if="new_user.official_photo==null"
                    style="width:300px; height:300px; border: 1px solid; display:inline-block;"
                  ></div>
                  <img v-else style="width:300px; height:300px;" :src="new_user.official_photo" />
                  <b-form-file style="width:300px; text-align:left" @change="onFileChange"></b-form-file>
                </div>
                <div class="col-md-8">
                  <label for="last_name">Last Name</label>
                  <b-input
                    id="last_name"
                    :state="required(new_user.last_name)"
                    v-model="new_user.last_name"
                  ></b-input>
                  <b-form-invalid-feedback
                    :state="required(new_user.last_name)"
                  >This is a required field</b-form-invalid-feedback>

                  <!-- FIRST NAME  -->

                  <label for="first_name">First Name</label>
                  <b-input
                    id="first_name"
                    :state="required(new_user.first_name)"
                    v-model="new_user.first_name"
                  ></b-input>
                  <b-form-invalid-feedback
                    :state="required(new_user.first_name)"
                  >This is a required field</b-form-invalid-feedback>

                  <!-- MIDDLE NAME  -->

                  <label for="middle_name">Middle Name</label>
                  <b-input
                    id="middle_name"
                    :state="required(new_user.middle_name)"
                    v-model="new_user.middle_name"
                  ></b-input>
                  <b-form-invalid-feedback
                    :state="required(new_user.middle_name)"
                  >This is a required field</b-form-invalid-feedback>

                  <!-- MIDDLE NAME  -->

                  <label for="employment_date">Employment Date</label>
                  <b-input id="employment_date" type="date" v-model="new_user.employment_date"></b-input>

                  <label for="birth_date">Birth Date</label>
                  <b-input id="birth_date" type="date"></b-input>
                </div>
              </div>
            </div>

            <hr class="mt-3" />

            <!-- CONTACT DETAILS-->
            <div id="contact_details">
              <div class="row">
                <div class="col-md-12">
                  <h4>
                    <i>Contact Details</i>
                  </h4>
                </div>
              </div>
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <label for="pdem_email">
                        PDEM Email
                        <i
                          class="fas fa-question-circle"
                          v-b-tooltip.hover
                          title="PDEM Email will be used to login in PDIS"
                        ></i>
                      </label>
                      <b-input-group id="pdem_email" :append="pdem_email">
                        <b-form-input v-model="new_user.pdem_email"></b-form-input>
                      </b-input-group>
                    </div>
                    <div class="row">
                      <label for="pdem_gmail">
                        PDEM GMail
                        <i class="fas fa-question-circle"></i>
                      </label>
                      <b-form-input id="pdem_gmail" v-model="new_user.pdem_gmail"></b-form-input>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="contact_numbers">Contact Numbers</label>
                        <b-input-group
                          v-for="(contact_number, index) in new_user.contact_numbers"
                          :key="index"
                        >
                          <b-form-input v-model="new_user.contact_numbers[index]"></b-form-input>
                          <b-input-group-append>
                            <b-button
                              variant="outline-danger"
                              :disabled="index<1"
                              @click="removeContact(index)"
                            >
                              <i class="fas fa-window-close"></i>
                            </b-button>
                          </b-input-group-append>
                        </b-input-group>
                        <b-button
                          variant="outline-primary"
                          block
                          @click="addContact"
                        >Add Contact Number</b-button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr class="mt-3" />
            <!-- JOB DETAILS -->
            <div id="job_description">
              <div class="row">
                <div class="col-md-12">
                  <h4>
                    <i>Job Details</i>
                  </h4>
                </div>
              </div>

              <!-- OFFICE:  Choose between PGOS or PGAS -->
              <!-- Choose between available groups -->
              <!-- Choose between available positions -->

              <!-- GROUP -->
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <label for="group">Group</label>
                      <b-input id="group" v-model="new_user.group"></b-input>
                    </div>
                    <div class="row">
                      <label for="group">Job Level</label>
                      <b-form-select :options="job_levels">
                        <template v-slot:first>
                          <b-form-select-option :value="null" disabled>Select Level</b-form-select-option>
                        </template>
                      </b-form-select>
                      <b-input id="group" v-model="new_user.group"></b-input>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <b-input type="number"></b-input>
                  </div>
                </div>
              </div>
              <!-- DEPARTMENT -->

              <!-- JOB POSITION -->
              <!-- JOB LEVEL -->
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <b-button variant="success" block @click="createUser">Create User</b-button>
              </div>
            </div>
          </b-tab>
          <b-tab title="Module Access" active>
            <module-access></module-access>
          </b-tab>
        </b-tabs>
      </b-card-text>
    </b-card>
  </div>
  <!--  -->
</template>

<script>
import adminNav from "../../../components/authorized/navigation/AdminNav";
import validators from "../../../mixins/validators";
import moduleAccess from "./Add User/ModuleAccess";
export default {
  data() {
    return {
      job_levels: ["1A", "1B", "1C", "1D"],
      new_user: {
        last_name: "",
        first_name: "",
        middle_name: "",
        employment_date: "1997-07-11",
        official_photo: null,
        pdem_email: "",
        pdem_gmail: "",
        contact_numbers: [""],
        group: ""
      },
      pdem_email: "@projectduoevents.com"
    };
  },
  mixins: [validators],
  components: {
    "admin-nav": adminNav,
    "module-access": moduleAccess
  },
  methods: {
    /* 
    Remove Contact:
      - PARAMETERS:
        - index: Takes on the index of the contact to be removed in the array
      - DESCRIPTION:
        - This function is responsible for removing the correct element in the contact_numbers array.
    */

    /* 
    Add Contact:
      - PARAMETERS:
        - NONE
      - DESCRIPTION:
        - This function is responsible for addin an element in the contact_numbers array.
    */

    addContact() {
      this.new_user.contact_numbers.push("");
    },

    /* 
    Required:
      - PARAMETERS:
        - item: Object to be used for verification purposes
      - DESCRIPTION:
        - This function is responsible for validating if the string is empty or not.
    */

    onFileChange(e) {
      const file = e.target.files[0];
      this.new_user.official_photo = URL.createObjectURL(file);
    },

    createUser() {
      swal
        .fire({
          title: "Create User",
          icon: "question",
          confirmButtonText: "Create User",
          text: "Please check the details provided.",
          showLoaderOnConfirm: true,
          preConfirm: () => {
            this.$Progress.start();
            return new Promise((resolve, reject) => {
              axios
                .post("/api/user", this.new_user)
                .then(response => {
                  const user = response.data;
                  resolve(user);
                })
                .catch(e => {
                  this.$Progress.fail();
                  console.log(e);
                  swal.showValidationMessage(`Unable to create user`);
                  swal.hideLoading();
                  reject(e);
                });
            });
          }
        })
        .then(result => {
          if (result.value) {
            this.$Progress.finish();
            console.log(result);
            swal.fire({
              title: "User Succesfully Created",
              icon: "success",
              timer: "2500",
              text:
                "The default password has been sent to the user's PDEM Email",
              onClose: () => {
                // this.$router.push({ name : "Dashboard"});
              }
            });
          }
        });
    }
  },
  computed: {}
};
</script>
