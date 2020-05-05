<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/mandates">List of Manpower</b-breadcrumb-item>
			<b-breadcrumb-item active>Create Manpower</b-breadcrumb-item>
		</b-breadcrumb>
		<!-- Progress Bar -->

		<item-progress class="mt-3" :steps="steps" :mode="mode"></item-progress>
		<!-- Main Mandate Form -->

		<create-mandate :steps="steps" :endpoints="endpoints"></create-mandate>
	</div>
</template>

<script>
import createMandate from "./Create/CreateMandate"
export default {
  data() {
    return {
      mode: "Create",
      steps: this.$store.state.mandate.steps,
      endpoints:{
        api: "/api/mandate",
        show_route: "mandate_show"
      },
    };
  },

  components: {
    "create-mandate": createMandate
  }
};
</script>