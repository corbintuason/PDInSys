<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Add User</h1>
      </template>
      <b-card-text>
        <b-tabs content-class="mt-3" fill>
          <b-tab title="User Details" acive>
            <user-details :new_user="new_user"></user-details>
          </b-tab>
          <b-tab title="Module Access">
            <module-access :new_user="new_user"></module-access>
          </b-tab>
        </b-tabs>
        {{new_user}}
        <b-button variant="success" block @click="createUser" class="mt-3">Create User</b-button>
      </b-card-text>
    </b-card>
  </div>
  <!--  -->
</template>

<script>
import adminNav from "../../../components/authorized/navigation/AdminNav";
import userDetails from "./Add User/UserDetails";
import moduleAccess from "./Add User/ModuleAccess";
export default {
  data() {
    return {
      new_user: {
        last_name: "",
        first_name: "",
        middle_name: "",
        employment_date: "1997-07-11",
        official_photo: null,
        pdem_email: "",
        pdem_gmail: "",
        contact_numbers: [""],
        job_details:{
          office: null,
          group: null,
          department: null
        },
        module_access:{
        }
      }
    };
  },
  components: {
    "admin-nav": adminNav,
    "module-access": moduleAccess,
    "user-details": userDetails
  },
  methods:{
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
