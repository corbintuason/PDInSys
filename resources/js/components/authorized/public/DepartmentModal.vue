<template>
  <b-modal size="lg" id="add-client" hide-footer>
    <template v-slot:modal-title>Add Client</template>
    <div class="d-block text-center container">
      <!-- CLIENT NAME -->
      <div class="row">
        <div class="col-md-2">
          <label class="float-left">Salutation</label>
          <b-form-select v-model="new_client.salutation" :options="salutations">
            <template v-slot:first>
              <b-form-select-option :value="null" disabled>Select Salutation</b-form-select-option>
            </template>
          </b-form-select>
        </div>
        <div class="col-md-5">
          <label class="float-left">Last Name</label>
          <b-input type="text" v-model="new_client.last_name"></b-input>
        </div>
        <div class="col-md-5">
          <label class="float-left">First Name</label>
          <b-input type="text" v-model="new_client.first_name"></b-input>
        </div>
      </div>

      <!-- CONTACT INFORMATION PART 1-->
      <div class="row mt-2">
        <div class="col-md-4">
          <label class="float-left">Mobile Number</label>
          <b-input type="number" v-model="new_client.mobile_number"></b-input>
        </div>
        <div class="col-md-4">
          <label class="float-left">Local Number</label>
          <b-input type="text" v-model="new_client.local_number"></b-input>
        </div>
        <div class="col-md-4">
          <label class="float-left">Designation</label>
          <b-input type="text" v-model="new_client.designation"></b-input>
        </div>
      </div>

      <!-- CONTACT INFORMATION PART 2 -->
       <div class="row mt-2">
        <div class="col-md-6">
          <label class="float-left">Email Address</label>
          <b-input type="number" v-model="new_client.email_address"></b-input>
        </div>
        <div class="col-md-6">
          <label class="float-left">Birthday</label>
          <b-input type="date" v-model="new_client.birthday"></b-input>
        </div>
      </div>

      <!-- CLIENT POSITION -->
        <b-button variant="outline-success" @click="addClient">Add Client</b-button>
    </div>
    {{new_client}}
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      salutations: [
        { value: "Mr.", text: "Mr." },
        { value: "Ms.", text: "Ms." },
        { value: "Mrs.", text: "Mrs." }
      ],
      new_client: {
        salutation: null,
        last_name: "",
        first_name: "",
        designation: "",
        brand: "",
        department: "",
        mobile_number: "",
        local_number: "",
        email_address: "",
        birthday: ""
      }
    };
  },
  props: {
    clients: Array
  },
  methods:{
      addClient(){
          this.clients.push(this.new_client);
          this.$bvModal.hide('add-client');
      }
  }
};
</script>