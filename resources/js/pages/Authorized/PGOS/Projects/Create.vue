<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" :steps="steps" :mode="mode"></item-progress>
    <!-- Main Project Form -->

    <create-project :steps="steps" :endpoints="endpoints"></create-project>

  </div>
</template>

<script>
import createProject from "./Create/CreateProject"
export default {
  data() {
    return {
      mode: "Create",
      steps: this.$store.state.project.steps,
      endpoints:{
        api: "/api/project",
        show_route: "project_show"
      },
    };
  },

  components: {
    "create-project": createProject
  }
};
</script>