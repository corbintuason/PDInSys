<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div v-for="(office, office_index) in offices" :key="office_index">
          <div class="component-sub-header">{{office.name}}</div>
          <div class="component-sub-content">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>Module</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody
                v-for="(pdis_module, pdis_module_index) in office.modules"
                :key="pdis_module_index"
              >
                <strong>{{pdis_module.section}}</strong>

                <tr v-for="(feature, feature_index) in pdis_module.features" :key="feature_index">
                  <td>
                    <b-form-checkbox></b-form-checkbox>
                  </td>
                  <td>{{feature.name}}</td>
                  <td>
                    <b-form-select v-if="feature.roles!=null" :options="feature.roles" size="sm"></b-form-select>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <b-alert
          v-if="new_user.job_details.office== null"
          show
          variant="warning"
        >Please select an Office to start assigning specific access control</b-alert>
        <b-table striped hover :fields="fields" :items="items" table-variant="warning"></b-table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      fields: [
        {
          key: "module",
          label: "Module"
        },
        {
          key: "role",
          label: "Role"
        }
      ],
      offices: this.$store.state.globals.offices
    };
  },
  props: {
    new_user: Object
  }
};
</script>
