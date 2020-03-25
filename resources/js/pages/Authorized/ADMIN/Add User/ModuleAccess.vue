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
                        :options="feature.roles"
                        size="sm"
                        @change="selectRole($event, office, pdis_module, feature)"
                        :disabled="featureDisabled(office, pdis_module, feature)"
                      ></b-form-select>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      module_key: 0,
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
  watch: {},
  props: {
    new_user: Object,
    module_access: Array
  },
  methods: {
    // SELECT OFFICE
    addOffice(event, office) {
      if (event) {
        this.new_user.module_access.push({
          name: office.name,
          modules: []
        });
      } else {
        var splice_module = this.new_user.module_access.findIndex(
          pdis_module => pdis_module.name == office.name
        );
        this.new_user.module_access.splice(splice_module, 1);
      }
    },
    // SELECT SECTION
    selectSection(event, office, pdis_module) {
      var involved_office = this.new_user.module_access.find(
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
      var involved_office = this.new_user.module_access.find(
        pdis_module => pdis_module.name == office.name
      );
      if (event) {
        var involved_feature = involved_office.modules.find(
          test_feature => test_feature.section == duo_module.section
        );
        involved_feature.features.push({
          name: feature.name,
          role: null
        });

      } else {
        var involved_module = involved_office.modules.find(test_feature => test_feature.section == duo_module.section);
        var splice_feature = involved_module.features.findIndex(
          pdis_feature => pdis_feature.name == feature.name
        );
        involved_module.features.splice(splice_feature, 1);
      }
    },
    // SELECT ROLE
    selectRole(event, office, duo_module, feature) {
      // GET OFFICE
      var involved_office = this.new_user.module_access.find(
        pdis_module => pdis_module.name == office.name
      );
      // GET MODULE
      var involved_module = involved_office.modules.find(
          test_module => test_module.section == duo_module.section
      );
      // GET FEATURE
      var involved_feature = involved_module.features.find(
          test_feature => test_feature.name == feature.name
      );
      involved_feature.role = event;

    },

    // RENDERING FEATURES
    renderModules(office, pdis_module) {
      var involved_office = this.new_user.module_access.find(
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
    featureDisabled(office, duo_module, feature) {
      var involved_office = this.new_user.module_access.find(
        pdis_module => pdis_module.name == office.name
      );
      
      // GET MODULE
      var involved_module = involved_office.modules.find(
          test_module => test_module.section == duo_module.section
      );
      // GET FEATURE
      var result = true;
      involved_module.features.forEach(pdis_feature => {
        if(pdis_feature.name == feature.name){
          result = false;
        }
      }); return result;
    },
    renderModule(office) {
      var result = false;
      this.new_user.module_access.forEach(pdis_module => {
        if (pdis_module.name == office.name) {
          result = true;
        }
      });
      return result;
    }
  }
};
</script>
