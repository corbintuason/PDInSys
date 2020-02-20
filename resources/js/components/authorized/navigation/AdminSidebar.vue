<template>
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <router-link :to="{ name: 'Dashboard' }" class="brand-link">
      <div class="row">
        <div class="col-md-12">
          <img
            :src="'../storage/img/PROJECTDUO_ExtendedLogo.png'"
            alt="PROJECT DUO Logo"
            class="brand-image"
          />
        </div>
      </div>
    </router-link>

    <div class="sidebar">
      <!-- User Panel -->
      <user-panel :user="user"> </user-panel>

      <!-- Sidebar Menu -->
      <nav class="mt-2 user-panel">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- PGOS RELATED -->
          <pgos-panel></pgos-panel>
         

          <!-- PGAS -->
          <pgas-panel></pgas-panel>

          <!-- ModuleLess -->
          <module-less></module-less>
        </ul>
      </nav>
    </div>
  </aside>
</template>

<script>
import userPanel from "./SideBar/UserPanel"
import pgosPanel from "./SideBar/PGOSPanel"
import pgasPanel from "./SideBar/PGASPanel"
import moduleLess from "./SideBar/ModuleLess"
export default {
  data() {
    return {
      user: JSON.parse(localStorage.getItem("user"))
    };
  },
  components:{
    "user-panel": userPanel,
    "pgos-panel": pgosPanel,
    "pgas-panel": pgasPanel,
    "module-less": moduleLess
  },
  methods: {
  },
  mounted() {
    console.log(this.user);
  }
};
</script>