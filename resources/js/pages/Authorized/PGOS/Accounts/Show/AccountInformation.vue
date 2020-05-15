<template>
    <div>
    <!-- Account Details Section -->
    <account-details :account="account" :mode="mode"></account-details>
    <hr />

    <div class="row">
    <terms-of-payment class="col-md-6" :account="account"></terms-of-payment>
    <payment-milestone class="col-md-6" :account="account"></payment-milestone>
    </div>

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