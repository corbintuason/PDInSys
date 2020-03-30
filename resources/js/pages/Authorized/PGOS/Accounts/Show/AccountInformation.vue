<template>
  <div v-if="account!=null">
    <!-- Account Details Section -->
    <account-details :mode="mode" :account="account"></account-details>
    <hr />
    <!-- Terms of Payment -->
    <terms-of-payment :mode="mode" :account="account"></terms-of-payment>
    <hr>
    <!-- Payment Milestone -->
    <payment-milestone :mode="mode" :account="account"></payment-milestone>
    <hr>
    <!-- Company Tel Number -->
    <company-tel-number :mode="mode" :account="account"></company-tel-number>
    <hr>
    <!-- Company Email Address -->
    <company-email-address :mode="mode" :account="account"></company-email-address>
    <hr>
    <!-- Accrediation Status -->
    <accreditation-status :mode="mode" :account="account"></accreditation-status>
    <hr />
    <!-- Brands Departments -->
    <brands-departments :mode="mode" :account="account"></brands-departments>
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
      account: Object,
      mode: String
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