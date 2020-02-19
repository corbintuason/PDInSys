<template>
  <div>
    <admin-nav></admin-nav>
    <div class="content-wrapper">
      <div class="content">
        <div class="container-fluid">
          <b-card class="mt-3" header="Add User">
            <b-card-text>
              <!-- PERSONAL INFORMATION -->
              <div id="personal_information">
                <div class="row">
                  <div class="col-md-12">
                    <h4>
                      <i>Personal Information</i>
                    </h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mt-3" style="text-align:center">
                    <!-- If there is no image uploaded -->
                    <div
                      v-if="new_user.image==null"
                      style="width:300px; height:300px; border: 1px solid; display:inline-block;"
                    ></div>
                    <img v-else style="width:300px; height:300px;" :src="new_user.image" />
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
                            @click="addNumber"
                          >Add Contact Number</b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <hr class="mt-3" />
              <!-- JOB DESCRIPTION -->
              <div id="job_description">
                <div class="row">
                  <div class="col-md-12">
                    <h4>
                      <i>Job Description</i>
                    </h4>
                  </div>
                </div>
                <!-- GROUP -->
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <label for="group">Group</label>
                        <b-input id="group" v-model="new_user.group"></b-input>
                      </div>
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
            </b-card-text>
          </b-card>
        </div>
        <!--  -->
      </div>
    </div>
  </div>
</template>

<script>
import adminNav from "../../../components/authorized/navigation/AdminNav";

export default {
  data() {
    return {
      new_user: {
        last_name: "",
        first_name: "",
        middle_name: "",
        employment_date: "1997-07-11",
        image: null,
        pdem_email: "",
        pdem_gmail: "",
        contact_numbers: [""],
        group: ""
      },
      pdem_email: "@projectduoevents.com"
    };
  },
  components: {
    "admin-nav": adminNav
  },
  methods: {
    removeContact(index) {
      this.new_user.contact_numbers.splice(index, 1);
    },
    addNumber() {
      this.new_user.contact_numbers.push("");
    },
    required(item) {
      return item.length > 0;
    },
    onFileChange(e) {
      const file = e.target.files[0];
      this.new_user.image = URL.createObjectURL(file);
    },
    createUser() {
      swal.fire({
        title: "Create User",
        text: "Are you sure with the details provided?",
        icon: "question",
        confirmButtonText: "Proceed",
        showCancelButton: true,
        cancelButtonText: "Go Back"
      }).then(response => {
        if(response.value){
          this.app.req.post('auth/register', this.new_user).then(response => {
            this.app.user = response.data;
            this.$router.push("/");
          });
        }
      })
    }
  },
  computed: {}
};
</script>
