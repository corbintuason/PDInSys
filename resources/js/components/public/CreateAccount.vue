<template>
  <b-modal id="create-account" size="xl">
    <div class="row">
      <div class="col-md-12">
        <b-tabs content-class="mt-3" :key="tabs_index">
          <b-tab title="Create Accounts" active>
            <!-- Account Details Section -->
            <!-- <account-details :form="form"></account-details>
            <hr />
            <accreditation-status :form="form"></accreditation-status>
            <hr />
            <brand-department :form="form"></brand-department> -->
            <!-- <client-details :form="form"></client-details> -->
            <b-button variant="outline-success" class="float-right">Create Client</b-button>
          </b-tab>

          <!-- Create Client -->
          <b-tab title="Create Client" :disabled="brands_departments_empty = true">
            <p>Create Client</p>
          </b-tab>
        </b-tabs>
      </div>
    </div>
  </b-modal>
</template>

<script>
// import accountDetails from "../../components/authorized/admin/accounts/create/AccountDetails";
// import accreditationStatus from "../../components/authorized/admin/accounts/create/AccreditationStatus";
// import BrandDepartment from "../../components/authorized/admin/accounts/create/BrandDepartment";
// import clientDetails from "../../components/authorized/admin/accounts/create/ClientDetails";

export default {
  data() {
    return {
        tabs_index: 0,
        brands_departments_empty: false,
      form: {
        registered_name: "",
        registered_address: "",
        registered_tin: "",
        terms_of_payment: "",
        payment_milestone: "",
        company_tel_number: "",
        company_email_address: "",
        clients: [],
        accreditation_status: [""],
        brands: []
      }
    };
  },
  computed:{
      brands(){
          return this.form.brands;
      },
      departments(){

      }
  },
  watch:{
      brands(){
          this.tabs_index++;
          //("may nagbago");
      }
  },
  components: {
    "account-details": accountDetails,
    "accreditation-status": accreditationStatus,
    "client-details": clientDetails,
    "brand-department": BrandDepartment
  },
  methods:{
      checkBrandsDepartments(){
        //   If brands is empty, return false
        if(this.form.brands.length > 0){
            this.form.brands.forEach(brand => {
                if(brand.departments.length >0){
                    return true;
                }
          })
        } else{
            return false;
        }
         
      }
  },
  mounted(){
      this.checkBrandsDepartments();
  }
};
</script>