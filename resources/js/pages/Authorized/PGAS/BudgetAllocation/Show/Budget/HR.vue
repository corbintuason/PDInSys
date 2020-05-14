<template>
	<div>
		<div class="hr">
			<b-card>
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h6>
							<strong>
								<b-input-group prepend="₱" class="font-weight-bold">
									<money readonly class="form-control" :value="hum_grand_total"></money>
								</b-input-group>
							</strong>
						</h6>
					</div>
				</div>
				<hr />
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h6>
							<strong>Human Resource</strong>
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
		hum_grand_total() {
			var total_amount = 0;
			this.budget.forEach(center => {
				center.hum_budget_details.forEach(detail => {
					total_amount += Number(detail.hum_budget_year);
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