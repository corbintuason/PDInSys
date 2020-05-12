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
			{{budget}}
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
				adm_grand_total: null,
				cost_centers: [
					{
						adm_cost_code: "",
						adm_cost_description: "",
						adm_cost_total: null,
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