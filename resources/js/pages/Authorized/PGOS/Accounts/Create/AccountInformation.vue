<template>
  <div>
    <!-- Account Details Section -->
    <account-details :form="form"></account-details>
    <hr />
    <accreditation-status :form="form"></accreditation-status>
    <hr />
    <brands-departments :form="form"></brands-departments>
  </div>
</template>

<script>

import accountDetails from "./AccountInformation/AccountDetails"
import accreditationStatus from "./AccountInformation/AccreditationStatus"
import brandsDepartments from "./AccountInformation/BrandsDepartment"

export default{
    data(){
        return{

        }
    },
    props:{
      form: Object
    },
    components:{
      "account-details": accountDetails,
      "accreditation-status": accreditationStatus,
      "brands-departments": brandsDepartments
    }
}
</script>