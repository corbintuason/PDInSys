<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" :front_steps="front_steps" :current_step="0"></item-progress>
    
    <!-- Main Project Form -->

    <create-project></create-project>

  </div>
</template>

<script>
import createProject from "./Create/CreateProject"
export default {
  data() {
    return {
      front_steps: this.$store.state.globals.statuses.project.front_steps,
      account_options: [{ value: 1, text: "GLOBE" }]
    };
  },

  components: {
    "create-project": createProject
  }
};
</script>