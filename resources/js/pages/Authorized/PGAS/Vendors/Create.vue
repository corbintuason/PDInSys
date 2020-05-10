<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/vendors">List of Vendors</b-breadcrumb-item>
			<b-breadcrumb-item active>Create Vendor</b-breadcrumb-item>
		</b-breadcrumb>
		<!-- Progress Bar -->

		<item-progress class="mt-3" :steps="steps" :mode="mode"></item-progress>
		<!-- Main Vendor Form -->

		<create-vendor :steps="steps" :endpoints="endpoints"></create-vendor>
	</div>
</template>

<script>
import createVendor from "./Create/CreateVendor"
export default {
  data() {
    return {
      mode: "Create",
      steps: this.$store.state.vendor.steps,
      endpoints:{
        api: "/api/vendor",
        show_route: "vendor_show"
      },
    };
  },

  components: {
    "create-vendor": createVendor
  }
};
</script>