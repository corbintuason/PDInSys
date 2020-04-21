<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" :front_steps="front_steps" v-if="project!=null" :db_steps="db_steps" :item="project" :mode="mode"></item-progress>
   
    <!-- Main Project Details -->

    <show-project v-if="project!=null" :project="project" :front_steps="front_steps" :mode="mode"></show-project>

    <!-- Change Logs  -->
    <change-logs v-if="change_logs!=null" :logs="change_logs"></change-logs>
    
  </div>
</template>

<script>
import changeLogs from "../../../../components/public/ChangeLogs";
import showProject from "./Show/ShowProject"
export default {
  data() {
    return {
      mode: "Show",
      front_steps: this.$store.state.globals.statuses.project.front_steps,
      db_steps: this.$store.state.globals.statuses.project.db_steps,
      project: null,
      change_logs: null
    };
  },

  components: {
    "show-project": showProject,
    "change-logs": changeLogs
  },
  methods:{
      loadProject(){
          var project_id = this.$route.params.id
          axios.get("/api/project/" +project_id).then(response => {
              this.project = response.data.data;
              this.change_logs = response.data.actions;
          })
      }
  },
  mounted(){
      this.loadProject();
  },
};
</script>