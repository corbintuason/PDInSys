<template>
	<div>
		<!-- Annual Budget for Year:-->
		<div class="row">
			<div class="col-md-10">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<b-card bg-variant="primary" class="mt-3 text-center annual-budget">
								<b-card-text>
									<h2>
										<strong>{{budget.annual_budget}}</strong>
									</h2>
								</b-card-text>
							</b-card>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>
				<div class="col-md-12 mt-4">
					<b-card>
						<template v-slot:header>
							<h1 class="component-title">Budget Allocation</h1>
						</template>
						<template v-slot:footer></template>
						<b-card-text>
							<!-- <div class="row">
								<div class="col-md-12">
									<div class="col-md-2 mt-2 text-center">
										<label>Annual Budget for Year:</label>
									</div>
									<div class="col-md-2">
										<b-form-input
											readonly
											v-model="budget.annual_budget"
											class="budget-year text-center"
											type="number"
										></b-form-input>
									</div>
								</div>
							</div>
							<hr />-->
							<!-- All Cost Center -->
							<div>
								<all-cost-center :budget="budget" :tabIndex="tabIndex"></all-cost-center>
							</div>
						</b-card-text>
					</b-card>
				</div>
			</div>
			<div class="col-md-2 mt-3">
				<all-budget :budget="budget"></all-budget>
			</div>
		</div>
		<!-- End Annual Budget for Year:-->
		<div>
			<div class="row">
				<div class="col-md-2 mt-3">
					<!-- All Budget -->
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import form from "../../../../mixins/form";
import allBudget from "./Show/AllBudget";
import allCostCenter from "./Show/AllCostCenter";
export default {
	data() {
		return {
			tabIndex: 0,
			name: "Show Budget Allocation",
			item_model: "Budget Allocation",
			user: this.$store.state.user
		};
	},
	props: {
		steps: Array,
		budget: Object,
		budget_code: String,
		mode: String,
		endpoints: Object
	},
	mixins: [form],
	components: {
		"all-budget": allBudget,
		"all-cost-center": allCostCenter
	}
};
</script>

<style lang="scss" scoped>
.annual-budget {
	border-radius: 10px;
}
</style>