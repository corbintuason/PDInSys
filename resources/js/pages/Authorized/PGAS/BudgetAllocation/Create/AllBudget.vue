<template>
	<div>
		<!-- Admin -->
		<adm-budget :budget="budget"></adm-budget>
		<!-- AFG -->
		<afg-budget></afg-budget>
		<!-- BOD -->
		<bod-budget></bod-budget>
		<!-- Human Resources -->
		<hr-budget></hr-budget>
		<!-- OPS  -->
		<ops-budget></ops-budget>
		<!-- Annual Budget  -->
		<annual-budget></annual-budget>
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
		return {
			budget: {
				adm_grand_total: null,
				cost_centers: [
					{
						adm_cost_code: "",
						adm_cost_description: "",
						adm_budget_details: [
							{
								adm_budget_code: "",
								adm_budget_description: "",
								adm_budget_year: null,
								adm_budget_month: null
							}
						]
					}
				]
			}
		};
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