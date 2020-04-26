<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" :front_steps="front_steps" v-if="project!=null" :db_steps="db_steps" :item="project" :contributors="contributors" :mode="mode" :api_link="api_link" :remarks="remarks"></item-progress>
   
    <!-- Main Project Details -->

    <show-project v-if="project!=null" :project="project" :project_code="project_code" :front_steps="front_steps" :core_team="core_team" :mode="mode" :contributors="contributors"></show-project>

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
      api_link: "/api/project",
      front_steps: this.$store.state.globals.statuses.project.front_steps,
      db_steps: this.$store.state.globals.statuses.project.db_steps,

      project: null,
      change_logs: null,
      core_team: null,
      project_code: null,
      contributors: null,
      remarks: null
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
              this.core_team = response.data.relationships;
              this.project_code = response.data.meta.code;
              this.contributors = response.data.relationships.contributors
              this.remarks = response.data.relationships.remarks
          })
      }
  },
  mounted(){
      this.loadProject();
  },
};
</script>