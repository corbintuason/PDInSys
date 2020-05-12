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
						value="Head of Admin"
						class="text-center assign-budget text-dark"
						type="text"
					></b-form-input>
				</div>
			</div>
			<div class="col-md-2 text-center">
				<div class="mt-5 mr-3">
					<b-button class="mt-1" @click="addCostCenter(budget.cost_centers)" variant="success" block>
						<i class="fas fa-plus"></i>
						<strong>Add Cost Center</strong>
					</b-button>
				</div>
			</div>
		</div>
		<!-- Cost Center -->
		<div
			class="cost-center mb-3"
			v-for="(value, value_index) in budget.cost_centers"
			:key="value_index"
		>
			<div class="row">
				<div class="col-md-12 text-right">
					<b-button
						v-if="value_index != 0"
						:disabled="value_index==0"
						@click="removeCostCenter(budget.cost_centers, value_index)"
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
					<b-form-input v-model="budget.cost_centers[value_index].adm_cost_code" type="text"></b-form-input>
				</div>
				<div class="col-md-5">
					<b-form-input v-model="budget.cost_centers[value_index].adm_cost_description" type="text"></b-form-input>
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
				v-for="(value, value_index) in budget.cost_centers[value_index].adm_budget_details"
				:key="value_index"
			>
				<div class="col-md-3 ml-md-auto">
					<b-form-input v-model="value.adm_budget_code" type="text"></b-form-input>
				</div>
				<div class="col-md-3">
					<b-form-input v-model="value.adm_budget_description" type="text"></b-form-input>
				</div>
				<div class="col-md-2">
					<b-input-group prepend="₱" append="/ yr" class="font-weight-bold">
						<b-form-input v-model="value.adm_budget_year" placeholder="000,000.00"></b-form-input>
					</b-input-group>
				</div>
				<div class="col-md-2">
					<b-input-group prepend="₱" append="/ mo." class="font-weight-bold">
						<b-form-input
							v-model="value['adm_cost_total']"
							:value="
                                            getTotalBudgetMonth(
                                                value['adm_budget_month'], value['adm_budget_year']
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
						@click="removeRow(budget.cost_centers[value_index].adm_budget_details[value_index], value_index)"
						variant="outline-danger"
					>
						<i class="fas fa-trash"></i>
					</b-button>
				</div>
			</div>
			<!-- Budget Code Add button -->

			<div class="row ml-5 mr-5 mt-4 mb-4">
				<b-button @click="addRow(budget.cost_centers[value_index].adm_budget_details)" block>
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
		return {

		};
	},
	methods: {
		addCostCenter(model) {
			model.push({
				// cost_centers: [{
				adm_cost_code: "",
				adm_cost_description: "",
				adm_cost_total: 0,
				adm_budget_details: [
					{
						adm_budget_code: "",
						adm_budget_description: "",
						adm_budget_year: null,
						adm_budget_month: null
					}
				]
				// }]
			});
		},
		addRow(model) {
			model.push({
				adm_budget_code: "",
				adm_budget_description: "",
				adm_budget_year: null,
				adm_budget_month: null
			});
		},
		removeCostCenter(model, index) {
			model.splice(index, 1);
		},
		removeRow(model, index) {
			model.splice(index, 1);
		}
	},
	watch:{
	},
	computed: {
		getTotalBudgetMonth() {
			return (adm_budget_month, adm_budget_year) => {
				var adm_budget_month = adm_budget_year / 12;

				return adm_budget_month;
			};
		},
		total_budget_year() {
			return center => {
				var sum = 0;
				center.adm_budget_details.forEach(value => {
					sum += Number(value.adm_budget_year);
				});
				return sum;
			};
		},
		budget_grand_total() {
			console.log("hi im computing");
			var sum = 0;
			this.budget.cost_centers.forEach(value => {	
			console.log("checking val", value);
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