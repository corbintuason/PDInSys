<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/budget-allocation">Budget Allocation</b-breadcrumb-item>
			<b-breadcrumb-item active>Create Budget Allocation</b-breadcrumb-item>
		</b-breadcrumb>
		<div class="row">
			<div class="col-md-10">
				<b-card class="mt-3">
					<template v-slot:header>
						<h1 class="component-title">Budget Allocation</h1>
					</template>
					<b-card-text>
						<div class="mt-3">
							<b-tabs
								active-nav-item-class="font-weight-bold text-uppercase"
								v-model="tabIndex"
								content-class="mt-3"
								justified
							>
								<b-tab title="Administration" active>
									<!-- ADM -->
									<budget-allocation :form="form"></budget-allocation>
								</b-tab>
								<b-tab title="Accounting and Finance Group">
									<!-- AFG -->
								</b-tab>
								<b-tab title="Board of Directors">
									<!-- BOD -->
								</b-tab>
								<b-tab title="Human Resource">
									<!-- HR -->
								</b-tab>
								<b-tab title="Operations">
									<!-- OPS -->
								</b-tab>
							</b-tabs>
						</div>
					</b-card-text>
					<template v-slot:footer>
						<div class="row">
							<div class="col-md-6">
								<b-button-group class="mt-1">
									<b-button @click="tabIndex--">Previous Tab</b-button>
									<b-button @click="tabIndex++">Next Tab</b-button>
								</b-button-group>
							</div>
							<div class="col-md-6">
								<b-button variant="success" class="float-right">Create Budget</b-button>
								<b-button variant="dark" class="float-right mr-2">Save</b-button>
							</div>
						</div>
					</template>
				</b-card>
			</div>
			<div class="col-md-2 mt-3">
				<!-- Admin -->
				<adm-budget></adm-budget>
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
		</div>
	</div>
</template>

<script>
import budgetAllocation from "./Create/BudgetAllocation";
import annualBudget from "./Create/Budget/AnnualBudget";
import admBudget from "./Create/Budget/ADM";
import afgBudget from "./Create/Budget/AFG";
import bodBudget from "./Create/Budget/BOD";
import hrBudget from "./Create/Budget/HR";
import opsBudget from "./Create/Budget/OPS";
export default {
	data() {
		return {
			tabIndex: 0,
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
		"budget-allocation": budgetAllocation,
		"annual-budget": annualBudget,
		"adm-budget": admBudget,
		"bod-budget": bodBudget,
		"afg-budget": afgBudget,
		"hr-budget": hrBudget,
		"ops-budget": opsBudget
	}
}
</script>

<style lang="scss" scoped>
.total-amount {
	border: 1px solid #3333;
	background: #e9ecef;
}
</style>