<template>
	<div>
		<div class="row mt-2 mb-4">
			<b-input-group prepend="₱" class="font-weight-bold">
				<b-form-input readonly :value="budget_grand_total" class="total-amount" type="text"></b-form-input>
			</b-input-group>
			<div class="col-md-10">
				<div class="col-md-4 mt-2 text-center">
					<label>ASSIGN BUDGET TO:</label>
				</div>
				<div class="col-md-4">
					<b-form-input
						readonly
						value="Accounting Head"
						class="text-center assign-budget text-dark"
						type="text"
					></b-form-input>
				</div>
			</div>
			<div class="col-md-2 text-center">
				<div class="mt-5 mr-3">
					<b-button class="mt-1" @click="addCostCenter(budget.acc_cost_centers)" variant="success" block>
						<i class="fas fa-plus"></i>
						<strong>Add Cost Center</strong>
					</b-button>
				</div>
			</div>
		</div>
		<!-- Cost Center -->
		<div
			class="cost-center mb-3"
			v-for="(value, value_index) in budget.acc_cost_centers"
			:key="value_index"
		>
			<div class="row">
				<div class="col-md-12 text-right">
					<b-button
						v-if="value_index != 0"
						:disabled="value_index==0"
						@click="removeCostCenter(budget.acc_cost_centers, value_index)"
						variant="danger"
						pill
					>
						<i class="fas fa-times"></i>
					</b-button>
				</div>
			</div>
			<!-- first row -->
			<div class="row ml-1 mt-1 mb-3">
				<div class="col-md-3">
					<label>Cost Center</label>
				</div>
				<div class="col-md-5">
					<label>Cost Center Description</label>
				</div>
				<div class="col-md-3">
					<label>Total Amount:</label>
				</div>
				<div class="col-md-3">
					<b-form-input v-model="budget.acc_cost_centers[value_index].acc_cost_code" type="text"></b-form-input>
				</div>
				<div class="col-md-5">
					<b-form-input v-model="budget.acc_cost_centers[value_index].acc_cost_description" type="text"></b-form-input>
				</div>
				<div class="col-md-3">
					<b-input-group prepend="₱" class="font-weight-bold">
						<b-form-input
							readonly
							:value="total_budget_year(value)"
							class="total-amount"
							placeholder="000,000.00"
							type="text"
						></b-form-input>
					</b-input-group>
				</div>
			</div>
			<!-- end first row -->
			<!-- second row -->
			<div class="row ml-1 mt-4">
				<div class="col-md-3 ml-md-auto">
					<label>Budget Code</label>
				</div>
				<div class="col-md-3">
					<label>Description and Components</label>
				</div>
				<div class="col-md-2">
					<label>Budget per year</label>
				</div>
				<div class="col-md-2">
					<label>Budget per month</label>
				</div>
				<div class="col-md-1"></div>
			</div>
			<div
				class="row ml-1 mb-3"
				v-for="(value, value_index) in budget.acc_cost_centers[value_index].acc_budget_details"
				:key="value_index"
			>
				<div class="col-md-3 ml-md-auto">
					<b-form-input v-model="value.acc_budget_code" type="text"></b-form-input>
				</div>
				<div class="col-md-3">
					<b-form-input v-model="value.acc_budget_description" type="text"></b-form-input>
				</div>
				<div class="col-md-2">
					<b-input-group prepend="₱" append="/ yr" class="font-weight-bold">
						<b-form-input v-model="value.acc_budget_year" placeholder="000,000.00"></b-form-input>
					</b-input-group>
				</div>
				<div class="col-md-2">
					<b-input-group prepend="₱" append="/ mo." class="font-weight-bold">
						<b-form-input
							:value="
                                            getTotalBudgetMonth(
                                                value['acc_budget_month'], value['acc_budget_year']
                                            )
                                        "
							class="total-amount"
							placeholder="000,000.00"
							disabled
						></b-form-input>
					</b-input-group>
				</div>

				<div class="col-md-1">
					<b-button
						:disabled="value_index==0"
						@click="removeRow(budget.acc_cost_centers[value_index].acc_budget_details, value_index)"
						variant="outline-danger"
					>
						<i class="fas fa-trash"></i>
					</b-button>
				</div>
			</div>
			<!-- Budget Code Add button -->

			<div class="row ml-5 mr-5 mt-4 mb-4">
				<b-button @click="addRow(budget.acc_cost_centers[value_index].acc_budget_details)" block>
					<i class="text-white fas fa-plus"></i>
				</b-button>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		budget: Object
	},
	data() {
		return {};
	},
	methods: {
		addCostCenter(model) {
			model.push({
				// acc_cost_centers: [{
				acc_cost_code: "",
				acc_cost_description: "",
				acc_cost_total: 0,
				acc_budget_details: [
					{
						acc_budget_code: "",
						acc_budget_description: "",
						acc_budget_year: null,
						acc_budget_month: null
					}
				]
				// }]
			});
		},
		addRow(model) {
			model.push({
				acc_budget_code: "",
				acc_budget_description: "",
				acc_budget_year: null,
				acc_budget_month: null
			});
		},
		removeCostCenter(model, index) {
			model.splice(index, 1);
		},
		removeRow(model, index) {
			model.splice(index, 1);
		}
	},
	computed: {
		getTotalBudgetMonth() {
			return (acc_budget_month, acc_budget_year) => {
				var acc_budget_month = acc_budget_year / 12;

				return acc_budget_month;
			};
		},
		total_budget_year() {
			return center => {
				var sum = 0;
				center.acc_budget_details.forEach(value => {
					sum += Number(value.acc_budget_year);
				});
				return sum;
			};
		},
		budget_grand_total() {
			var sum = 0;
			this.budget.acc_cost_centers.forEach(value => {
				var budget_year = this.total_budget_year(value);
				sum += budget_year;
			});
			return sum;
		}
	}
};
</script>

<style lang="scss" scoped>
.assign-budget {
	border: 2px solid #6c757d;
}
.cost-center {
	background: #e9ecef;
	border-left: 10px solid #6c757d;
	border-right: 10px solid #6c757d;
	border-radius: 5px;
	padding: 10px;
	margin: 15px;

	.total-amount {
		border: 1px solid #3333;
		background: #e9ecef;
	}
}
</style>