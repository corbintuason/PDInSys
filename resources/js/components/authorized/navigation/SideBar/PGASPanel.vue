<template>
  <div>
    <div class="pgas-header text-center">
      <a class="text-white">
        <strong>PGOS</strong>
      </a>
    </div>
    <div>
      <ul
        class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false"
      >
        <!-- Admin -->
        <li class="nav-item has-treeview">
          <a v-if="renderSection('Admin')" href="#" class="nav-link">
            <i class="fas fa-user" style="margin-right:10px"></i>
            <p>
              Admin
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li v-if="renderFeature('Admin', 'Companies')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Companies</p>
              </a>
            </li>
            <li v-if="renderFeature('Admin', 'ADM Advisories')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>ADM Advisories</p>
              </a>
            </li>
            <li v-if="renderFeature('Admin', 'Assets')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Assets</p>
              </a>
            </li>
            <li v-if="renderFeature('Admin', 'Vehicles')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Vehicles</p>
              </a>
            </li>
            <li v-if="renderFeature('Admin', 'Warehouses')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Warehouses</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Accounting -->
        <li class="nav-item has-treeview">
          <a v-if="renderSection('Accounting')" href="#" class="nav-link">
            <i class="fas fa-user" style="margin-right:10px"></i>
            <p>
              Accounting
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li v-if="renderFeature('Accounting', 'Accounts')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Accounts</p>
              </a>
            </li>
            <li v-if="renderFeature('Accounting', 'Vendors')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Vendors</p>
              </a>
            </li>
            <li v-if="renderFeature('Accounting', 'AFG Advisories')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>AFG Advisories</p>
              </a>
            </li>
            <li
              v-if="renderFeature('Accounting', 'Billing and Collection Monitor')"
              class="nav-item"
            >
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Billing and Collection Monitor</p>
              </a>
            </li>
            <li v-if="renderFeature('Accounting', 'Budget Allocation')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Budget Allocation</p>
              </a>
            </li>
            <li
              v-if="renderFeature('Accounting', 'Projected Financial Statements')"
              class="nav-item"
            >
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Projected Financial Statement</p>
              </a>
            </li>
            <li
              v-if="renderFeature('Accounting', 'Sales, Purchase, and Allowance Register')"
              class="nav-item"
            >
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Sales, Purchase, and Allowance Register</p>
              </a>
            </li>
            <li v-if="renderFeature('Accounting', 'Sales Report')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Sales Report</p>
              </a>
            </li>
            <li v-if="renderFeature('Accounting', 'Payments')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Payments</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Human Resource -->
        <li class="nav-item has-treeview">
          <a v-if="renderSection('Human Resource')" href="#" class="nav-link">
            <i class="fas fa-user" style="margin-right:10px"></i>
            <p>
              Human Resource
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li v-if="renderFeature('Human Resource', 'HR Advisories')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>HR Advisories</p>
              </a>
            </li>
            <li v-if="renderFeature('Human Resource', 'Mandate')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Mandate</p>
              </a>
            </li>
            <li v-if="renderFeature('Human Resource', 'PDIS')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>PDIS</p>
              </a>
            </li>
            <!-- Add or Modify User collapse -->
            <li v-if="renderFeature('Human Resource', 'Sprout HR')" class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Sprout HR</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  props:{
    module_access: Array,
      pgas: Object,
  },
  methods: {
    renderSection(section) {
      var result = false;
      this.pgas.modules.forEach(pdis_section => {
        if (pdis_section.section == section) {
          result = true;
        }
      });
      return result;
    },
    renderFeature(section, feature) {
      var result = false;
      var involved_section = this.pgas.modules.find(
        pdis_section => pdis_section.section == section
      );
      involved_section.features.forEach(pdis_feature => {
        if (pdis_feature.name == feature) {
          result = true;
        }
      });
      return result;
    }
  }
};
</script>

<style lang="scss" scoped>
.pgas-header {
  background: #f7942c;
  margin: 15px 5px 15px 5px;
  padding: 7px;
  border-radius: 5px;
}
</style>