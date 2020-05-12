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
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-2 mt-2 text-center">
									<label>Annual Budget for Year:</label>
								</div>
								<div class="col-md-2">
									<b-form-input class="budget-year text-center" type="number"></b-form-input>
								</div>
							</div>
						</div>
						<!-- All Cost Center -->
						<div>
							<all-cost-center :tabIndex="tabIndex"></all-cost-center>
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
				<!-- All Budget -->
				<all-budget :budget="budget"></all-budget>
			</div>
		</div>
	</div>
</template>

<script>
import allBudget from "./Create/AllBudget";
import allCostCenter from "./Create/AllCostCenter";
export default {
	props: {
		budget: Object
	},
	data() {
		return {
			tabIndex: 0
		};
	},
	components: {
		"all-budget": allBudget,
		"all-cost-center": allCostCenter
	}
};
</script>

<style lang="scss" scoped>
.total-amount {
	border: 1px solid #3333;
	background: #e9ecef;
}
.budget-year {
	border: 2px solid #6c757d;
}
</style>