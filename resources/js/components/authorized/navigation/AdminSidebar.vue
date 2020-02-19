<template>
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <router-link :to="{ name: 'Dashboard' }" class="brand-link">
      <img
        :src="'../storage/img/PROJECTDUO_ExtendedLogo.png'"
        alt="PROJECT DUO Logo"
        class="brand-image"
      />
      <span class="brand-text font-weight-light">PDIS</span>
    </router-link>
    <div class="sidebar">
      <nav class="mt-2 user-panel">
        <!-- USER SEGMENT -->
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item has-treeview">
            <span class="nav-link">
              <img />
              <p>User</p>
              <i class="right fas fa-angle-left"></i>
            </span>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/profile" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>My Profile</p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" @click="logOut">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>

      <nav class="mt-2 user-panel">
        <!-- USER SEGMENT -->

        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item has-treeview">
            <span class="nav-link">
              <img />
              <p>PGOS</p>
              <i class="right fas fa-angle-left"></i>
            </span>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/profile" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Accounts and Clients</p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>

      <nav class="mt-2 user-panel">
        <!-- USER SEGMENT -->

        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item has-treeview">
            <span class="nav-link">
              <img />
              <p>PGAS</p>
              <i class="right fas fa-angle-left"></i>
            </span>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/profile" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Accounts and Clients</p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>

      <nav class="mt-2 user-panel">
        <!-- USER SEGMENT -->

        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item has-treeview">
            <span class="nav-link">
              <img />
              <p>ADMIN</p>
              <i class="right fas fa-angle-left"></i>
            </span>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link :to="{name: 'Add User'}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add New User</p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    logOut() {
      this.$store.dispatch('destroyToken').then(response => {
        this.$router.push({name: "Welcome"});
      });
    }
  },
  mounted() {}
};
</script>