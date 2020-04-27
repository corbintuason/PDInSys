<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/budget-allocation">Budget Allocation</b-breadcrumb-item>
			<b-breadcrumb-item active>Create Budget Allocation</b-breadcrumb-item>
		</b-breadcrumb>
		<b-card class="mt-4">
			<template v-slot:header>
				<h1 class="component-title">Budget Allocation</h1>
			</template>
			<b-card-text>
				<budget-allocation :form="form"></budget-allocation>
			</b-card-text>
			<template v-slot:footer>
				<b-button variant="success" class="float-right">Create Budget</b-button>
			</template>
		</b-card>
	</div>
</template>

<script>
import budgetAllocation from "./Create/BudgetAllocation";
export default {
	data() {
		return {
			form: {
				cost_centers: [{
					cost_code: "",
					cost_description: "",
					cost_total: 0,
					budget_details: [{
						budget_code: "",
						budget_description: "",
						budget_year: 0,
						budget_month: 0
					}]
				}]
			}
		}
	},
	components: {
		"budget-allocation": budgetAllocation
	}
}
</script>

<style>
</style>