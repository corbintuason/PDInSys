<template>
  <div>
    <!-- Progress Bar -->
    
    <item-progress class="mt-3" :my_steps="my_steps" :current_step="0"></item-progress>
    
    <!-- Main Project Form -->

    <create-project></create-project>

  </div>
</template>

<script>
import createProject from "./Create/CreateProject"
export default {
  data() {
    return {
      my_steps: ["Create", "Review", "Approve"],
      account_options: [{ value: 1, text: "GLOBE" }]
    };
  },

  components: {
    "create-project": createProject
  }
};
</script>