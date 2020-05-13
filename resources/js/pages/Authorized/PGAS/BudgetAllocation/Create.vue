<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/budget-allocation">Budget Allocation</b-breadcrumb-item>
			<b-breadcrumb-item active>Create Budget Allocation</b-breadcrumb-item>
		</b-breadcrumb>

		<create-budget-allocation :endpoints="endpoints"></create-budget-allocation>
	</div>
</template>

<script>
import createBudgetAllocation from "./Create/CreateBudgetAllocation";
export default {
	data() {
		return {
			mode: "Create",
			endpoints: {
				api: "/api/budget-allocation",
				show_route: "budget_allocation_show"
			}
		};
	},
	components: {
		"create-budget-allocation": createBudgetAllocation
	}
};
</script>
