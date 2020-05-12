<template>
	<div>
		<div class="mt-3">
			<b-tabs
				active-nav-item-class="font-weight-bold text-uppercase"
				v-model="tabIndex"
				content-class="mt-3"
				justified
			>
				<b-tab title="Administration" active>
					<!-- ADM -->
					<adm-cost-center :budget="budget"></adm-cost-center>
				</b-tab>
				<b-tab title="Accounting and Finance Group">
					<!-- AFG -->
					<acc-cost-center :budget="budget"></acc-cost-center>
				</b-tab>
				<b-tab title="Board of Directors">
					<!-- BOD -->
					<bod-cost-center :budget="budget"></bod-cost-center>
				</b-tab>
				<b-tab title="Human Resource">
					<!-- HR -->
					<hum-cost-center :budget="budget"></hum-cost-center>
				</b-tab>
				<b-tab title="Operations">
					<!-- OPS -->
					<ops-cost-center :budget="budget"></ops-cost-center>
				</b-tab>
			</b-tabs>
			<!-- {{budget}} -->
		</div>
	</div>
</template>

<script>
import admCostCenter from "./components/AdmCostCenter";
import accCostCenter from "./components/AccCostCenter";
import bodCostCenter from "./components/BodCostCenter";
import humCostCenter from "./components/HumCostCenter";
import opsCostCenter from "./components/OpsCostCenter";
export default {
	data() {
		return {
			tabIndex: 0,
			budget: {
				adm_cost_centers: [
					{
						adm_cost_code: "",
						adm_cost_description: "",
						adm_budget_details: [
							{
								adm_budget_code: "",
								adm_budget_description: "",
								adm_budget_year: null
							}
						]
					}
				],
				acc_cost_centers: [
					{
						acc_cost_code: "",
						acc_cost_description: "",
						acc_budget_details: [
							{
								acc_budget_code: "",
								acc_budget_description: "",
								acc_budget_year: null
							}
						]
					}
				],
				bod_cost_centers: [
					{
						bod_cost_code: "",
						bod_cost_description: "",
						bod_budget_details: [
							{
								bod_budget_code: "",
								bod_budget_description: "",
								bod_budget_year: null
							}
						]
					}
				],
				hum_cost_centers: [
					{
						hum_cost_code: "",
						hum_cost_description: "",
						hum_budget_details: [
							{
								hum_budget_code: "",
								hum_budget_description: "",
								hum_budget_year: null
							}
						]
					}
				],
				ops_cost_centers: [
					{
						ops_cost_code: "",
						ops_cost_description: "",
						ops_budget_details: [
							{
								ops_budget_code: "",
								ops_budget_description: "",
								ops_budget_year: null
							}
						]
					}
				]
			}
		};
	},
	components: {
		"adm-cost-center": admCostCenter,
		"acc-cost-center": accCostCenter,
		"bod-cost-center": bodCostCenter,
		"hum-cost-center": humCostCenter,
		"ops-cost-center": opsCostCenter
	}
};
</script>

<style>
</style>