<template>
  <div>
    <!-- Account Details Section -->
    <account-details :form="form"></account-details>
    <hr />

    <div class="row">
    <terms-of-payment class="col-md-6" :form="form"></terms-of-payment>
    <payment-milestone class="col-md-6" :form="form"></payment-milestone>
    </div>

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