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
          <pgos-panel v-if="renderPGOS" :module_access="user.data.module_access" :pgos="pgos"></pgos-panel>
         

          <!-- PGAS -->
          <pgas-panel v-if="renderPGAS" :module_access="user.data.module_access" :pgas="pgas"></pgas-panel>

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
    return{
      renderPGOS: false,
      renderPGAS: false,
      pgos: null,
      pgas: null,
    }
  },
  props:{
    user: Object
  },
  components:{
    "user-panel": userPanel,
    "pgos-panel": pgosPanel,
    "pgas-panel": pgasPanel,
    "module-less": moduleLess
  },
  methods: {
    renderPanels(){
      var offices = this.$store.state.globals.offices;
      console.log("rendering")
      console.log(this.user.data.module_access);
      this.user.data.module_access.forEach(office => {
        if(office.name == "PGOS"){
          this.renderPGOS = true;
        }
        if(office.name == "PGAS"){
          this.renderPGAS = true;
        }
      })
      console.log(this.user.data.module_access);
    },
    filterOffices(){
       const pgos = this.user.data.module_access.find(pdis_module => pdis_module.name == "PGOS");
       const pgas = this.user.data.module_access.find(pdis_module => pdis_module.name == "PGAS");
       console.log("hay");
       console.log(pgos.modules);
       this.pgos = pgos;
       this.pgas = pgas;
       
       this.renderPanels();

    }
  },
  mounted() {
    this.filterOffices();
  }
};
</script>