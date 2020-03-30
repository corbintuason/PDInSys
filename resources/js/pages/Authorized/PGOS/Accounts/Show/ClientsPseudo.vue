<template>
  <div class="d-block container">
    <h1 class="component-title">Current Clients</h1>
    <div class="row">
      <div class="col-md-12">
        <!-- <basic-table :items="department.clients" :fields="fields" :key="clients_key"></basic-table> -->
      </div>
    </div>
    <hr />
    <!-- CLIENT NAME -->
    <h1 class="component-title">Add Client</h1>
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
        <b-input type="email" v-model="new_client.email_address"></b-input>
      </div>
      <div class="col-md-6">
        <label class="float-left">Birthday</label>
        <b-input type="date" v-model="new_client.birthday"></b-input>
      </div>
    </div>

    <!-- CLIENT POSITION -->
    <br />
    <b-button block variant="outline-primary" @click="addClient">Add Client</b-button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      clients_key: 0,
      fields: [
        {
          key: "salutation",
          label: "Salutation",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "last_name",
          label: "Last Name",
          sortable: true,
          class: "text-center"
        },
        {
          key: "designation",
          label: "Designation",
          sortable: true,
          class: "text-center"
        },
        {
          key: "mobile_number",
          label: "Mobile Number",
          sortable: true,
          class: "text-center"
        },
        {
          key: "local_number",
          label: "Local Number",
          sortable: true,
          class: "text-center"
        },
        {
          key: "email_address",
          label: "Email Address",
          sortable: true,
          class: "text-center"
        },
        {
          key: "birthday",
          label: "Birthday",
          sortable: true,
          class: "text-center"
        }
      ],
      salutations: [
        { value: "Mr.", text: "Mr." },
        { value: "Ms.", text: "Ms." },
        { value: "Mrs.", text: "Mrs." }
      ],
      new_client: {
        salutation: null,
        last_name: null,
        first_name: null,
        designation: null,
        brand: null,
        department: null,
        mobile_number: null,
        local_number: null,
        email_address: null,
        birthday: null
      }
    };
  },
  props: {
    form: Object,
  },
  watch: {},
  methods: {
    addClient() {
      this.department.clients.push(this.new_client);
      this.new_client =  {
        salutation: null,
        last_name: null,
        first_name: null,
        designation: null,
        brand: null,
        department: null,
        mobile_number: null,
        local_number: null,
        email_address: null,
        birthday: null
      };
    }
  }
};
</script>