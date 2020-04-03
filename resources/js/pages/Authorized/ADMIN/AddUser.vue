<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Add User</h1>
      </template>
      <b-card-text>
        <b-tabs v-model="tabIndex" content-class="mt-3" fill>
          <b-tab title="User Details" acive>
            <user-details :new_user="new_user"></user-details>
          </b-tab>
          <b-tab title="Module Access">
            <module-access :new_user="new_user" :module_access="new_user.module_access"></module-access>
          </b-tab>
        </b-tabs>
        <div class="row mt-4">
          <div class="col-md-12 text-center">
            <b-button-group class="mt-1">
              <b-button variant="primary" @click="tabIndex--">Previous</b-button>
              <b-button variant="primary" @click="tabIndex++">Next</b-button>
            </b-button-group>
          </div>
        </div>
        {{ new_user }}
        <div>
          <b-button variant="success" block @click="createUser" class="mt-3">Create User</b-button>
        </div>
      </b-card-text>
    </b-card>
  </div>
  <!--  -->
</template>

<script>
import adminNav from "../../../components/authorized/navigation/AdminNav";
import userDetails from "./Add User/UserDetails";
import moduleAccess from "./Add User/ModuleAccess";
import form from "../../../mixins/form"
export default {
  data() {
    return {
      new_user: {
        last_name: "",
        first_name: "",
        middle_name: "",
        employment_date: null,
        birth_date: null,
        official_photo: null,
        pdem_email: "",
        pdem_gmail: "",
        contact_numbers: [""],
        job_details: {
          office: null,
          group: null,
          department: null,
          position: null,
          job_level: null
        },
        module_access: []
      },
      tabIndex: 0
    };
  },
  mixins:[form],
  components: {
    "admin-nav": adminNav,
    "module-access": moduleAccess,
    "user-details": userDetails
  },
  methods: {
    createUser() {
      this.createItem();
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
                  //(e);
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
            //(result);
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
