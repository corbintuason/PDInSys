<template>
  <b-modal id="add-client" size="xl" hide-footer>
    <template v-slot:modal-title>Add Client</template>
    <h1 class="component-sub-header">Client Details</h1>
    <div class="d-block container">
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
    </div>
    <h1 class="component-sub-header mt-3">Brands and Departments</h1>
    <div class="d-block container">
        <!-- If empty brands -->
       <b-alert v-if="form.brands.length < 1" variant="danger" show> No Brands have been registered </b-alert>
       <b-form-group v-else v-for="(brand, brand_index) in form.brands" :key="brand_index">
           <b-form-checkbox
        v-model="new_client.brands"
        :value="brand.name"
        switch
        size="lg"
        @change="selectBrand($event, brand)"
      >{{brand.name}}</b-form-checkbox>
      <div class = "container">
      <b-form-checkbox v-for="(department, department_index) in brand.departments" :key="department_index" @change="selectDepartment($event, brand, department)">
          {{department.name}}
      </b-form-checkbox>
      </div>
     
       </b-form-group>
       <b-button block variant="outline-primary" @click="addClient">Add Client</b-button>
      {{new_client}}
    </div>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
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
        birthday: null,
        brands: []
      },
      salutations: [
        { value: "Mr.", text: "Mr." },
        { value: "Ms.", text: "Ms." },
        { value: "Mrs.", text: "Mrs." }
      ]
    };
  },
  methods:{
      selectBrand(event, brand){
        //   Switch is true
          if(event!=null){
              this.new_client.brands.push({
                  id: brand.id,
                  name: event,
                  departments:[],
              });
          }else{
              var splice_brand = this.new_client.brands.findIndex(form_brand => brand.name == form_brand.name);
              this.new_client.brands.splice(splice_brand, 1);
          }
      },
      selectDepartment(event, brand, department){
          // Find the Brand and Department First 
          if(event!=null){
              var specific_brand = this.new_client.brands.find(brand);
              specific_brand.departments.push(department);
          }else{
              var splice_department = brand.departments.findIndex(form_department => department.name == form_department.name);
              brand.deparmtents.splice(splice_department, 1);
          }
      },
      addClient(){
          this.form.clients.push(this.new_client);
      }
  },
  props: {
    selected_client: Object,
    form: Object
  },
};
</script>