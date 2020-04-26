<template>
	<div>
		<div class="row ml-3 mt-2 mb-4">
			<div class="col-md-12 mt-2">
				<label>Budget Allocation for Year:</label>
			</div>
			<div class="col-md-2">
				<b-form-input class="budget-year text-center" size="lg" type="number"></b-form-input>
			</div>
		</div>
		<!-- Cost Center -->
		<div class="cost-center mb-3">
			<!-- first row -->
			<div class="row ml-3 mt-4 mb-3">
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
					<b-form-input type="text"></b-form-input>
				</div>
				<div class="col-md-5">
					<b-form-input type="text"></b-form-input>
				</div>
				<div class="col-md-3">
					<b-input-group prepend="₱" class="font-weight-bold">
						<b-form-input class="total-amount" placeholder="000,000.00" type="text" disabled></b-form-input>
					</b-input-group>
				</div>
			</div>
			<!-- end first row -->
			<!-- second row -->
			<div class="row ml-3 mt-4">
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

				<div class="col-md-3 ml-md-auto">
					<b-form-input type="text"></b-form-input>
				</div>
				<div class="col-md-3">
					<b-form-input type="text"></b-form-input>
				</div>
				<div class="col-md-2">
					<b-input-group prepend="₱" append="/ yr" class="font-weight-bold">
						<b-form-input placeholder="000,000.00" type="text"></b-form-input>
					</b-input-group>
				</div>
				<div class="col-md-2">
					<b-input-group prepend="₱" append="/ mo." class="font-weight-bold">
						<b-form-input class="total-amount" placeholder="000,000.00" type="text" disabled></b-form-input>
					</b-input-group>
				</div>
				<div class="col-md-1">
					<b-button variant="outline-danger">
						<i class="fas fa-trash"></i>
					</b-button>
				</div>
			</div>
			<div class="row ml-5 mr-5 mt-4 mb-4">
				<b-button variant="primary" block>
					<i class="text-white fas fa-plus"></i>
				</b-button>
			</div>
		</div>
		<div class="row ml-2 mr-2">
			<b-button variant="success" block>
				<i class="fas fa-plus"></i>
				<strong>Add Cost Center</strong>
			</b-button>
		</div>
	</div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.budget-year {
	border-left: 6px solid #f7942c;
	border-right: 6px solid #f7942c;
}
.cost-center {
	background: #e9ecef;
	border-top: 7px solid #f7942c;
	border-bottom: 7px solid #f7942c;
	border-radius: 5px;
	padding: 10px;
	margin: 15px;

	.total-amount {
		border: 1px solid #3333;
		background: #e9ecef;
	}
}
</style>