<template>
	<div>
		<!-- Annual Budget  -->
		<annual-budget
			:adm_cost_centers="budget.adm_cost_centers"
			:acc_cost_centers="budget.acc_cost_centers"
			:bod_cost_centers="budget.bod_cost_centers"
			:hum_cost_centers="budget.hum_cost_centers"
			:ops_cost_centers="budget.ops_cost_centers"
		></annual-budget>
		<!-- Admin -->
		<adm-budget :budget="budget.adm_cost_centers"></adm-budget>
		<!-- AFG -->
		<afg-budget :budget="budget.acc_cost_centers"></afg-budget>
		<!-- BOD -->
		<bod-budget :budget="budget.bod_cost_centers"></bod-budget>
		<!-- Human Resources -->
		<hr-budget :budget="budget.hum_cost_centers"></hr-budget>
		<!-- OPS  -->
		<ops-budget :budget="budget.ops_cost_centers"></ops-budget>
	</div>
</template>

<script>
import annualBudget from "./Budget/AnnualBudget";
import admBudget from "./Budget/ADM";
import afgBudget from "./Budget/AFG";
import bodBudget from "./Budget/BOD";
import hrBudget from "./Budget/HR";
import opsBudget from "./Budget/OPS";
export default {
	data() {
		return {};
	},
	props: {
		budget: Object
	},
	components: {
		"annual-budget": annualBudget,
		"adm-budget": admBudget,
		"bod-budget": bodBudget,
		"afg-budget": afgBudget,
		"hr-budget": hrBudget,
		"ops-budget": opsBudget
	}
};
</script>

<style>
</style>