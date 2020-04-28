<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" :front_steps="front_steps" :db_steps="db_steps" :mode="mode"></item-progress>
    <!-- Main Project Form -->

    <create-project :front_steps="front_steps"></create-project>

  </div>
</template>

<script>
import createProject from "./Create/CreateProject"
export default {
  data() {
    return {
      mode: "Create",
      front_steps: this.$store.state.globals.statuses.project.front_steps,
      db_steps: this.$store.state.globals.statuses.project.db_steps,
    };
  },

  components: {
    "create-project": createProject
  }
};
</script>