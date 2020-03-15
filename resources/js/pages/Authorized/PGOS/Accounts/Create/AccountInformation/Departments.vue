<template>
  <div>
    <label>Departments and Clients</label>
    <div class = "row">
      <div class = "col-md-12">
        <h5><strong>{{selected_brand.name}}</strong></h5>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <b-list-group>
          <b-list-group-item
            v-for="(department, index) in selected_brand.departments"
            :key="index"
            variant="light"
            href="#"
            @click="editDepartment(department)"
          >{{department.name}}</b-list-group-item>
        </b-list-group>
        <b-list-group-item variant="primary">
          <h4 class="mb-0">
            <b-input type="text" :placeholder="department_placeholder" v-model="temp_department"></b-input>
          </h4>
        </b-list-group-item>
        <b-button block variant="outline-primary" @click="addDepartment">Add Department</b-button>
      </div>
    </div>

    <department-modal v-if="selected_department!=null" :form="form" :department="selected_department"></department-modal>
  </div>
</template>

<script>
import departmentModal from "./DepartmentModal"
export default {
  data() {
    return {
      department_placeholder: "Department Name",
      selected_department: null,
      temp_department: null
    };
  },
  components:{
    "department-modal": departmentModal
  },
  props: {
    selected_brand: Object,
    form: Object
  },
  methods: {
    addDepartment() {
      this.selected_brand.departments.push({
        name: this.temp_department,
        clients: [
          {
            salutation: null,
            last_name: null,
            first_name: null,
            designation: null,
            mobile_number: null,
            local_number: null,
            email_address: null,
            birthday: null
          }
        ]
      });
      this.temp_department = null;
    },
    editDepartment(department) {
      this.selected_department = department;
      this.$bvModal.show("open-department");
    }
  }
};
</script>