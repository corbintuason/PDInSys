<template>
  <li class="nav-item menu-open">
    <div class="sidebar-header"></div>
    <a href="#" class="nav-link">
      <p>
        <strong class="orange">PGOS</strong>
      </p>
    </a>
    <ul
      class="nav nav-pills nav-sidebar flex-column"
      data-widget="treeview"
      role="menu"
      data-accordion="false"
    >
      <!-- Accounts and Clients -->
      <li class="nav-item has-treeview">
        <a v-if="renderSection('Accounts and Clients')" href="#" class="nav-link">
          <i class="fas fa-cog" style="margin-right:10px"></i>
          <p>
            Accounts and Clients
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview sidebar-links" style="display: none;">
          <li v-if="renderFeature('Accounts and Clients', 'View Accounts')" class="nav-item">
            <router-link :to="{ name: 'account_index'}" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>View Accounts</p>
            </router-link>
          </li>
          <li
            v-if="renderFeature('Accounts and Clients', 'Account and Client Accreditation')"
            class="nav-item"
          >
            <router-link :to="{ name: 'account_create'}" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Account and Client Accreditation</p>
            </router-link>
          </li>
        </ul>
      </li>
      <!-- Project Development -->
      <li class="nav-item has-treeview">
        <a v-if="renderSection('Project Development')" href="#" class="nav-link">
          <i class="fas fa-cog" style="margin-right:10px"></i>
          <p>
            Project Development
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
          <li
            v-if="renderFeature('Project Development', 'Project List and Status')"
            class="nav-item"
          >
            <router-link :to="{ name: 'project_index'}" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Project List and Status</p>
            </router-link>
          </li>
          <li v-if="renderFeature('Project Development', 'Create Project')" class="nav-item">
            <router-link :to="{ name: 'project_create'}" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Create Project</p>
            </router-link>
          </li>
          <li
            v-if="renderFeature('Project Development', 'CE and Budget Management')"
            class="nav-item"
          >
            <a href="#" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>CE and Budget Management</p>
            </a>
          </li>
          <li v-if="renderFeature('Project Development', 'Project Clearance')" class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Project Clearance and Reports</p>
            </a>
          </li>
        </ul>
      </li>
      <!-- Creative Services -->
      <li class="nav-item has-treeview">
        <a v-if="renderSection('Project Execution')" href="#" class="nav-link">
          <i class="fas fa-cog" style="margin-right:10px"></i>
          <p>
            Project Execution
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
          <li v-if="renderFeature('Project Execution', 'Vendors Pool')" class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Vendors Pool</p>
            </a>
          </li>
          <li v-if="renderFeature('Project Execution', 'Manpower Pool')" class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Manpower Pool</p>
            </a>
          </li>
          <li v-if="renderFeature('Project Execution', 'Warehouse Management')" class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Warehouse Management</p>
            </a>
          </li>
          <li v-if="renderFeature('Project Execution', 'Project Templates')" class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Project Templates</p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </li>
</template>

<script>
export default {
  data() {
    return {};
  },
  props: {
    module_access: Array,
    pgos: Object
  },
  methods: {
    renderSection(section) {
      var result = false;
      this.pgos.modules.forEach(pdis_section => {
        if (pdis_section.section == section) {
          result = true;
        }
      });
      return result;
    },
    renderFeature(section, feature) {
      var result = false;
      var involved_section = this.pgos.modules.find(
        pdis_section => pdis_section.section == section
      );
      console.log("section" + section);
      console.log("feature" + feature);
      console.log(this.pgos.modules);
      involved_section.features.forEach(pdis_feature => {
        if (pdis_feature.name == feature) {
          result = true;
        }
      });
      return result;
    }
  },
  mounted() {}
};
</script>