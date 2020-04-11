<template>
  <b-modal id="selected-client" size="xl" hide-footer>
    <template v-slot:modal-title>Update Client</template>
    <h1 class="component-sub-header">Client Details</h1>
          <b-form @submit.stop.prevent="addClient">
    <div class="d-block container">
        <!-- First Row -->
        <div
          v-for="(client_segment, client_segment_index) in client_segments"
          :key="client_segment_index"
          :id="client_segment.id"
          class="row"
        >
          <b-form-group
            v-for="(content, content_index) in client_segment.contents"
            :key=" content_index"
            :id="content.id"
            :class="content.column"
            :label="content.label"
          >
            <!-- Check form type -->

            <!-- If select type -->
            <b-form-select
              v-if="content.form=='select'"
              v-model="selected_client[content.model]"
              :options="content.options"
            >
              <b-form-select-option :value="null" disabled>Select {{content.label}}</b-form-select-option>
            </b-form-select>

            <!-- If input type -->
            <b-form-input
              v-else-if="content.form=='input'"
              :type="content.type"
              v-model="selected_client[content.model]"
            ></b-form-input>

         
          </b-form-group>
        </div>
    </div>
    <div>
      <div class="row">
        <div class="col-md-6">
          <div class="component-sub-header">Brands</div>
          <!-- If empty brands -->
          <b-alert
            v-if="form.brands.length < 1"
            variant="danger"
            show
          >No Brands have been registered</b-alert>
          <b-form-group v-else v-for="(brand, brand_index) in form.brands" :key="brand_index">
            <b-form-checkbox
              v-model="selected_client.brands"
              :value="brand"
              switch
              size="lg"
              @change="selectBrand($event, brand)"
            >{{brand}}</b-form-checkbox>
          </b-form-group>
        </div>
        <div class="col-md-6">
          <div class="component-sub-header">Departments</div>

          <b-alert
            v-if="form.departments.length < 1"
            variant="danger"
            show
          >No Departments have been registered</b-alert>
          <b-form-group
            v-else
            v-for="(department, department_index) in form.departments"
            :key="department_index"
          >
            <b-form-checkbox
              v-model="selected_client.departments"
              :value="department"
              switch
              size="lg"
              @change="selectDepartment($event, department)"
            >{{department}}</b-form-checkbox>
          </b-form-group>
        </div>
      </div>
      <b-button block variant="outline-primary" @click="updateClient">Save Changes</b-button>
    </div>
    {{selected_client}}
    </b-form>
  </b-modal>
</template>

<script>
import validators from "../../../../../../mixins/validators";
export default {
  data() {
    return {
      update_client: {
        salutation: null,
        last_name: null,
        first_name: null,
        designation: null,
        brand: null,
        mobile_number: null,
        local_number: null,
        email_address: null,
        birthday: null,
        brands: [],
        departments: []
      },
      client_segments: [
        {
          id: "first_row",
          contents: [
            {
              id: "salutation",
              column: "col-md-2",
              label: "Salutation",
              form: "select",
              model: "salutation",
              options: [
                { value: "Mr.", text: "Mr." },
                { value: "Ms.", text: "Ms." },
                { value: "Mrs.", text: "Mrs." }
              ],
              validators: [
                {
                  name: "required"
                }
              ]
            },
            {
              id: "last_name",
              column: "col-md-5",
              label: "Last Name",
              form: "input",
              model: "last_name",
              type: "text",
              validators:[
                  {
                      name: "required"
                  }
              ],
            },
            {
              id: "first_name",
              column: "col-md-5",
              label: "First Name",
              form: "input",
              model: "first_name",
              type: "text",
              validators:[
                  {
                      name: "required"
                  }
              ],
            },

          ]
        },
        {
          id: "second_row",
          contents: [
            {
              id: "mobile_number",
              column: "col-md-4",
              label: "Mobile Number",
              form: "input",
              model: "mobile_number",
              type: "number",
              validators:[
                {
                  name: "required"
                }
              ],
            },
            {
              id: "local_number",
              column: "col-md-4",
              label: "Local Number",
              form: "input",
              model: "local_number",
              type: "text"
            },
            {
              id: "designation",
              column: "col-md-4",
              label: "Designation",
              form: "input",
              model: "designation",

              type: "text"
            }
          ]
        },
        {
          id: "third_row",
          contents: [
            {
              id: "email_address",
              column: "col-md-6",
              label: "Email Address",
              form: "input",
              model: "email_address",
              type: "email",
              validators:[
                // {
                //   name: "required"
                // },
                {
                  name: "email"
                }
              ]
            },
            {
              id: "birthday",
              column: "col-md-6",
              label: "Birthday",
              form: "input",
              model: "birthday",
              type: "date"
            }
          ]
        }
      ]
    };
  },
  mixins: [validators],
  methods: {
    selectBrand(event, brand) {
      //   Switch is true
      if (event != null) {
        this.selected_client.brands.push(event);
      } else {
        var splice_brand = this.selected_client.brands.findIndex(
          form_brand => brand == form_brand
        );
        this.selected_client.brands.splice(splice_brand, 1);
      }
    },
    selectDepartment(event, department) {
      // Find the Brand and Department First
      if (event != null) {
        this.selected_client.departments.push(event);
      } else {
        var splice_department = this.selected_client.departments.findIndex(
          form_department => department == form_department
        );
        this.selected_client.departments.splice(splice_department, 1);
      }
    },
    updateClient() {
      this.$bvModal.hide('selected-client');
    }
  },
  props: {
    selected_client: Object,
    form: Object
  }
};
</script>