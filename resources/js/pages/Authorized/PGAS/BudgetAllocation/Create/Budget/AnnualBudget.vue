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
		adm_cost_centers: Array,
		acc_cost_centers: Array,
		bod_cost_centers: Array,
		hum_cost_centers: Array,
		ops_cost_centers: Array
	},
	computed: {
		// annual_grand_total() {
		// 	var total_amount = 0;
		// 	this.budget.forEach(center => {
		// 		center.adm_budget_details.forEach(detail => {
		// 			total_amount += Number(detail.adm_budget_year);
		// 		});
		// 		console.log("total amount is", total_amount);
		// 	});
		// 	return total_amount;
		// }
		annual_grand_total() {
			var total_amount = 0;

			this.adm_cost_centers.forEach(center => {
				center.adm_budget_details.forEach(detail => {
					total_amount += Number(detail.adm_budget_year);
				});
			});

			this.acc_cost_centers.forEach(center => {
				center.acc_budget_details.forEach(detail => {
					total_amount += Number(detail.acc_budget_year);
				});
			});

			this.bod_cost_centers.forEach(center => {
				center.bod_budget_details.forEach(detail => {
					total_amount += Number(detail.bod_budget_year);
				});
			});

			this.hum_cost_centers.forEach(center => {
				center.hum_budget_details.forEach(detail => {
					total_amount += Number(detail.hum_budget_year);
				});
			});

			this.ops_cost_centers.forEach(center => {
				center.ops_budget_details.forEach(detail => {
					total_amount += Number(detail.ops_budget_year);
				});
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