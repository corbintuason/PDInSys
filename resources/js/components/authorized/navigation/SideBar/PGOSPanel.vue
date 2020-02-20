<template>
 <li class="nav-item menu-open">
            <div class = " sidebar-header"></div>
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
                <a href="#" class="nav-link">
                  <i class="fas fa-cog" style="margin-right:10px"></i>
                  <p>
                    Accounts and Clients
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <router-link :to="{ name: 'account_index'}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>View Accounts</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link :to="{ name: 'account_create'}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Account and Client Accreditation</p>
                    </router-link>
                  </li>
                </ul>
              </li>
              <!-- Project Development -->
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-cog" style="margin-right:10px"></i>
                  <p>
                    Project Development
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Project List and Status</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Create Project</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>CE and Budget Management</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Project Clearance and Reports</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- Creative Services -->
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-cog" style="margin-right:10px"></i>
                  <p>
                    Project Execution
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Vendors Pool</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Manpower Pool</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Warehouse Management</p>
                    </a>
                  </li>
                  <li class="nav-item">
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
export default{
    data(){
        return{

        }
    }
}
</script>