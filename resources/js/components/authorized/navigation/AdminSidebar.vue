<template>
  <aside class="main-sidebar sidebar-light-primary elevation-1">
    <router-link :to="{ name: 'Dashboard' }">
      <div class="brand-image-holder">
        <img :src="'/img/logo/project-duo.png'" alt="Project Duo" class="brand-image" />
      </div>
    </router-link>

    <div class="sidebar">
      <!-- User Panel -->
      <!-- <user-panel :user="user"> </user-panel> -->

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
import pgosPanel from "./SideBar/PGOSPanel";
import pgasPanel from "./SideBar/PGASPanel";
import moduleLess from "./SideBar/ModuleLess";
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
    "pgos-panel": pgosPanel,
    "pgas-panel": pgasPanel,
    "module-less": moduleLess
  },
  methods: {
    renderPanels(){
      var offices = this.$store.state.globals.offices;
      //("rendering")
      //(this.user.data.module_access);
      this.user.data.module_access.forEach(office => {
        if(office.name == "PGOS"){
          this.renderPGOS = true;
        }
        if(office.name == "PGAS"){
          this.renderPGAS = true;
        }
      })
      //(this.user.data.module_access);
    },
    filterOffices(){
       const pgos = this.user.data.module_access.find(pdis_module => pdis_module.name == "PGOS");
       const pgas = this.user.data.module_access.find(pdis_module => pdis_module.name == "PGAS");
       //("hay");
       //(pgos.modules);
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

<style lang="scss" scoped>
* {
    box-sizing: border-box;
}
.brand-image-holder {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    margin-top: 10px;
}
.brand-image {
    height: 60px;
    width: 210px;
}
</style>
