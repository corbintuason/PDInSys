<template>
  <div>
    <!-- Account Details Section -->
    <account-details :form="form"></account-details>
    <hr />
    <!-- Terms of Payment -->
    <terms-of-payment :form="form"></terms-of-payment>
    <hr>
    <!-- Payment Milestone -->
    <payment-milestone :form="form"></payment-milestone>
    <hr>
    <!-- Company Tel Number -->
  
    <hr>
    <!-- Company Email Address -->
  
    <hr>
    <!-- Accrediation Status -->
    
    <hr />
    <!-- Brands Departments -->
  </div>
</template>

<script>

import accountDetails from "./AccountInformation/AccountDetails"
import termsOfPayment from "./AccountInformation/TermsOfPayment"
import paymentMilestone from "./AccountInformation/PaymentMilestone"
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
      "terms-of-payment": termsOfPayment,
            "payment-milestone": paymentMilestone,
            
      "brands-departments": brandsDepartments
    }
}
</script>