<template>
  <div>
    <div id="account_details">
      <h1 class="component-sub-header">Account Details</h1>
      <div class="component-sub-content">
        <div class="row">
          <div class="col-md-6">
            <label>Registered Name</label>
            <b-input-group>
              <b-input type="text" v-model="form.registered_name"></b-input>
            </b-input-group>
            <label>Registered Address</label>
            <b-input-group>
              <b-input type="text" v-model="form.registered_address"></b-input>
            </b-input-group>
            <label>Registered TIN</label>
            <b-input-group>
              <b-input type="text" v-model="form.registered_tin"></b-input>
            </b-input-group>
            <label>Terms of Payment</label>
            <b-input-group>
              <b-input type="text" v-model="form.terms_of_payment"></b-input>
            </b-input-group>
            <label>Payment Milestone</label>
            <b-input-group>
              <b-input type="text" v-model="form.payment_milestone"></b-input>
            </b-input-group>
            <label>Company Tel. Number</label>
            <b-input-group>
              <b-input type="text" v-model="form.company_tel_number"></b-input>
            </b-input-group>
            <label>Company Email Address</label>
            <b-input-group>
              <b-input type="email" v-model="form.company_email_address"></b-input>
            </b-input-group>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default{
  data(){
    return{

    }
  },
  props:{
    form: Object
  }
}
</script>