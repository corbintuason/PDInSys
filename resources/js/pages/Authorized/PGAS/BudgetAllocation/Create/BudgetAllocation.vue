<template>
	<div>
		<div class="row mt-2 mb-4">
			<div class="col-md-10">
				<div class="col-md-4 mt-2 text-center">
					<label>ASSIGN BUDGET TO:</label>
				</div>
				<div class="col-md-4">
					<b-form-input class="text-center assign-budget" type="text"></b-form-input>
				</div>
			</div>
			<div class="col-md-2 text-center">
				<div class="mt-5 mr-3">
					<b-button class="mt-1" @click="addCostCenter(form.cost_centers)" variant="success" block>
						<i class="fas fa-plus"></i>
						<strong>Add Cost Center</strong>
					</b-button>
				</div>
			</div>
		</div>
		<!-- Cost Center -->
		<div
			class="cost-center mb-3"
			v-for="(value, value_index) in form.cost_centers"
			:key="value_index"
		>
			<div class="row">
				<div class="col-md-12 text-right">
					<b-button
						v-if="value_index != 0"
						:disabled="value_index==0"
						@click="removeRow(form.cost_centers, value_index)"
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
					<b-form-input v-model="form.cost_centers[value_index].cost_code" type="text"></b-form-input>
				</div>
				<div class="col-md-5">
					<b-form-input v-model="form.cost_centers[value_index].cost_description" type="text"></b-form-input>
				</div>
				<div class="col-md-3">
					<b-input-group prepend="₱" class="font-weight-bold">
						<b-form-input
							v-model="form.cost_centers[value_index].cost_total"
							class="total-amount"
							placeholder="000,000.00"
							type="text"
							disabled
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
				v-for="(value, value_index) in form.cost_centers[value_index].budget_details"
				:key="value_index"
			>
				<div class="col-md-3 ml-md-auto">
					<b-form-input v-model="form.cost_centers[value_index].budget_details.budget_code" type="text"></b-form-input>
				</div>
				<div class="col-md-3">
					<b-form-input
						v-model="form.cost_centers[value_index].budget_details.budget_description"
						type="text"
					></b-form-input>
				</div>
				<div class="col-md-2">
					<b-input-group prepend="₱" append="/ yr" class="font-weight-bold">
						<b-form-input
							v-model="form.cost_centers[value_index].budget_details.budget_year"
							placeholder="000,000.00"
						></b-form-input>
					</b-input-group>
				</div>
				<div class="col-md-2">
					<b-input-group prepend="₱" append="/ mo." class="font-weight-bold">
						<b-form-input
							v-model="form.cost_centers[value_index].budget_details.budget_month"
							class="total-amount"
							placeholder="000,000.00"
							disabled
						></b-form-input>
					</b-input-group>
				</div>
				<div class="col-md-1">
					<b-button
						:disabled="value_index==0"
						@click="removeRow(form.cost_centers.budget_details, value_index)"
						variant="outline-danger"
					>
						<i class="fas fa-trash"></i>
					</b-button>
				</div>
			</div>
			<!-- Budget Code Add button -->
			<div class="row ml-5 mr-5 mt-4 mb-4">
				<b-button @click="addRow(form.budget_details)" block>
					<i class="text-white fas fa-plus"></i>
				</b-button>
			</div>
		</div>
		<!-- Cost Center Add Button -->
		<!-- <div class="row ml-1 mr-2">
			<b-button @click="addCostCenter(form.cost_centers)" variant="success" block>
				<i class="fas fa-plus"></i>
				<strong>Add Cost Center</strong>
			</b-button>
		</div>-->
	</div>
</template>

<script>
export default {
    props: {
        form: Object
    },
    data() {
        return {
            cost_centers: [{
                cost_code: "",
                cost_description: "",
                cost_total: 0,
				budget_code: "",
				budget_description: "",
				budget_year: "",
				budget_month: ""
            }]
        }
    },
	methods: {
        addCostCenter(model) {
            model.push({
                // cost_centers: [{
                    cost_code: "",
                    cost_description: "",
                    cost_total: 0,
					budget_details: [{
						budget_code: "",
						budget_description: "",
						budget_year: 0,
						budget_month: 0
					}]
                // }]
            });
        },
		addRow(model) {
            model.push({
                // budget_details: [{
                    budget_code: "",
                    budget_description: "",
                    budget_year: 0,
                    budget_month: 0
                // }]
            });
        },
        removeRow(model, index) {
            model.splice(index, 1);
        },
    },
    computed: {
        monthlyBudget() {
            calculatedMonthly = this.form.cost_centers.budget_details.budget_year / 12;
            this.form.cost_centers.budget_details = calculatedMonthly;

            return calculatedMonthly;
        }
    }
}
</script>

<style lang="scss" scoped>
.assign-budget {
	border: 2px solid #6c757d;
}
.cost-center {
	background: #e9ecef;
	border-left: 10px solid #f7942c;
	border-right: 10px solid #f7942c;
	border-radius: 5px;
	padding: 10px;
	margin: 15px;

	.total-amount {
		border: 1px solid #3333;
		background: #e9ecef;
	}
}
</style>