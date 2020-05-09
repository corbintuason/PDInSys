<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" v-if="project!=null" :steps="steps" :item="project" :mode="mode"></item-progress>
   
    <!-- Main Project Details -->

    <show-project v-if="project!=null" :project="project" :steps="steps" :mode="mode" :endpoints="endpoints" :key="show_project_key"></show-project>

    <!-- Change Logs  -->
    <change-logs v-if="project!=null" :logs="project.relationships.actions"></change-logs>
    
 
  </div>
</template>

<script>
import changeLogs from "../../../../components/public/ChangeLogs";
import showProject from "./Show/ShowProject"
export default {
  data() {
    return {
      mode: "Show",
      show_project_key: 0,
      steps: this.$store.state.project.steps,
        endpoints:{
        api: "/api/project/",
        show_route: "project_show"
      },
      project: null,
    };
  },

  components: {
    "show-project": showProject,
    "change-logs": changeLogs
  },
  watch:{
    mode(){
      this.show_project_key++;
    }
  },
  methods:{
      loadProject(){
          var project_id = this.$route.params.id
          axios.get("/api/project/" + project_id).then(response => {
              this.project = response.data.data;
          })
      }
  },
  mounted(){
      this.loadProject();

      Fire.$on('switch-mode', mode => {
        if(mode == 'Show'){
          this.loadProject();
         }
        this.mode = mode;
      });
  },
};
</script>