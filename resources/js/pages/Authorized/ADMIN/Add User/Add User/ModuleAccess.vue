<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div v-for="(office, office_index) in offices" :key="office_index">
          <div class="row mt-3">
            <div class="col-md-12 text-center">
              <b-form-checkbox
                style="display:inline-block"
                @change="addOffice($event, office)"
                switch
              ></b-form-checkbox>
              <div
                class="component-sub-header orange"
                style="font-weight:bold; display:inline-block"
              >{{office.name}}</div>
            </div>
          </div>

          <div class="component-sub-content">
            <table v-if="renderModule(office)" class="table table-striped table-hover">
              <thead class="thead-dark">
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
                <div style="display:inline-block">
                  <b-form-checkbox @change="selectSection($event, office, pdis_module)" stack></b-form-checkbox>
                </div>
                <strong style="display:inline-block">{{pdis_module.section}}</strong>

                <template v-if="renderModules(office, pdis_module)">
                  <tr v-for="(feature, feature_index) in pdis_module.features" :key="feature_index">
                    <td>
                      <b-form-checkbox
                        @change="selectFeature($event, office, pdis_module, feature)"
                      ></b-form-checkbox>
                    </td>
                    <td>{{feature.name}}</td>
                    <td>
                      <b-form-select
                        v-if="feature.roles!=null"
                        size="sm"
                        @change="selectRole($event, feature)"
                        :disabled="featureDisabled(feature)"
                      >
                      <b-form-select-option first disabled :value='null'>--Please select a role --</b-form-select-option>
                      <b-form-select-option v-for="(role, role_index) in feature.roles" :key="role_index" :value="role.role">{{role.name}}</b-form-select-option>
                      </b-form-select>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{new_user.module_access}}
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      module_key: 0,
      module_access: [],
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
    new_user: Object,
  },
  methods: {
    // SELECT OFFICE
    addOffice(event, office) {
      if (event) {
        this.module_access.push({
          name: office.name,
          modules: []
        });
      } else {
        var splice_module = this.module_access.findIndex(
          pdis_module => pdis_module.name == office.name
        );
        this.module_access.splice(splice_module, 1);
      }
    },
    // SELECT SECTION
    selectSection(event, office, pdis_module) {
      var involved_office = this.module_access.find(
        involved_module => involved_module.name == office.name
      );
      if (event) {
        involved_office.modules.push({
          section: pdis_module.section,
          features: []
        });
      } else {
        var test_section = involved_office.modules.findIndex(
          test_office => test_office.section == pdis_module.section
        );
        involved_office.modules.splice(test_section, 1);
      }
    },
    // SELECT FEATURE
    selectFeature(event, office, duo_module, feature) {

      if (event) {
        this.new_user.module_access.permissions.push(feature.permission);

      } else {
        var splice_feature = this.new_user.module_access.permissions.findIndex(
          user_feature => user_feature == feature.permission
        );
        this.new_user.module_access.permissions.splice(splice_feature, 1);
      }
    },

    // RENDERING FEATURES
    renderModules(office, pdis_module) {
      var involved_office = this.module_access.find(
        pdis_module => pdis_module.name == office.name
      );
      var result = false;
      involved_office.modules.forEach(involved_module => {
        if (involved_module.section == pdis_module.section) {
          result = true;
        }
      });
      return result;
    },
    featureDisabled(feature) {
      var render = true;
      this.new_user.module_access.permissions.forEach(permission => {
        if(permission == feature.permission) render = false;
      });
      console.log(render);
      return render;
    },

    renderModule(office) {
      var result = false;
      this.module_access.forEach(pdis_module => {
        if (pdis_module.name == office.name) {
          result = true;
        }
      });
      return result;
    },

    selectRole(event, feature){
      console.log('testing time');
      console.log(feature);
      console.log(this.new_user.module_access.roles)
      if(feature.roles.some(role => this.new_user.module_access.roles.includes(role.role))){
        var remove_roles = [];
        feature.roles.forEach(remove_role => {
          remove_roles.push(remove_role.role);
        });
        var test = this.new_user.module_access.roles.filter(user_role => !remove_roles.includes(user_role));
        this.new_user.module_access.roles = test;
      }
      this.new_user.module_access.roles.push(event);
      return true;
    }
  }
};
</script>
