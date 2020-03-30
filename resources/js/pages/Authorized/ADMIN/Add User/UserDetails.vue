<template>
  <div>
    <!-- PERSONAL INFORMATION -->
    <personal-information :new_user="new_user"></personal-information>
    <!-- CONTACT DETAILS -->
    <contact-details :new_user="new_user" class="mt-3"></contact-details>
    <!-- JOB DETAILS -->
    <job-details :new_user="new_user" class ="mt-3"></job-details>

  </div>
</template>
<script>
import personalInformation from "./UserDetails/PersonalInformation"
import contactDetails from "./UserDetails/ContactDetails"
import jobDetails from "./UserDetails/JobDetails"

export default {
  data() {
    return {
      fields: [
        {
          key: "module",
          label: "Module"
        },
        {
          key: "role",
          label: "Role"
        }
      ],
      items: [
        {
          module: "ACCOUNTS AND CLIENTS",
          style: "font-style:bold"
        },
        {
          module: "View Accounts"
        },
        {
          module: "Account and Client Accreditation"
        },
        //  Account and Client Acc. Roles:
        // - Create, Approve,
        {
          module: "PROJECT DEVELOPMENT"
        },
        {
          module: "Project List and Status"
        },
        {
          module: "Create Project"
        }
        // Roles:
        // Create, Review, Approve
      ],
      pdem_email: "@projectduoevents.com",
      job_levels: ["1A", "1B", "1C", "1D"]
    };
  },
  components:{
      "personal-information": personalInformation,
      "contact-details": contactDetails,
      "job-details": jobDetails
  }, 
  props: {
    new_user: Object
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

 
  }
};
</script>
