<template>
	<div>
		<div class="afg">
			<b-card>
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h6>
							<strong>
								<b-input-group prepend="₱" class="font-weight-bold">
									<money readonly class="form-control" :value="acc_grand_total"></money>
								</b-input-group>
							</strong>
						</h6>
					</div>
				</div>
				<hr />
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h6>
							<strong>Accounting and Finance Group</strong>
						</h6>
					</div>
				</div>
			</b-card>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		budget: Array
	},
	computed: {
		acc_grand_total() {
			var total_amount = 0;
			this.budget.forEach(center => {
				center.acc_budget_details.forEach(detail => {
					total_amount += Number(detail.acc_budget_year);
				});
				console.log("total amount is", total_amount);
			});
			return total_amount;
		}
	},
	data() {
		return {};
	}
};
</script>

<style>
</style>