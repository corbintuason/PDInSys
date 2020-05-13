<template>
	<div>
		<div class="annual">
			<b-card>
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h4>
							<strong>
								<b-input-group prepend="₱" class="font-weight-bold">
									<money readonly class="form-control" :value="annual_grand_total"></money>
								</b-input-group>
							</strong>
						</h4>
					</div>
				</div>
				<hr />
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h4>
							<strong>Annual Budget</strong>
						</h4>
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
		annual_grand_total() {
			var total_amount = 0;
			var adm_total = 0;
			var acc_total = 0;

			this.budget.forEach(center => {
				center.adm_budget_details.forEach(detail => {
					adm_total += Number(detail.adm_budget_year);
				});
				console.log("total amount is", adm_total);
			});
			this.budget.forEach(center => {
				center.acc_budget_details.forEach(detail => {
					acc_total += Number(detail.acc_budget_year);
				});
				console.log("total amount is", acc_total);
			});

			this.total_amount = this.adm_total + this.acc_total;

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