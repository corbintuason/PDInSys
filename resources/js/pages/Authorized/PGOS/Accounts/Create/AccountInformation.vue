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
    <company-tel-number :form="form"></company-tel-number>
    <hr>
    <!-- Company Email Address -->
    <company-email-address :form="form"></company-email-address>
    <hr>
    <!-- Accrediation Status -->
    <accreditation-status :form="form"></accreditation-status>
    <hr />
    <!-- Brands Departments -->
    <brands-departments :form="form"></brands-departments>
  </div>
</template>

<script>

import accountDetails from "./AccountInformation/AccountDetails"
import termsOfPayment from "./AccountInformation/TermsOfPayment"
import paymentMilestone from "./AccountInformation/PaymentMilestone"
import companyTelNumber from "./AccountInformation/CompanyTelNumber"
import companyEmailAddress from "./AccountInformation/CompanyEmailAddress"
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
      "terms-of-payment": termsOfPayment,
            "payment-milestone": paymentMilestone,
                  "company-tel-number": companyTelNumber,
                        "company-email-address": companyEmailAddress,
      "accreditation-status": accreditationStatus,
      "brands-departments": brandsDepartments
    }
}
</script>