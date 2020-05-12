<template>
	<div>
		<div class="adm">
			<b-card>
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h6>
							<!-- {{budget}} -->
							<strong>₱</strong>
							{{adm_grand_total}}
						</h6>
					</div>
				</div>
				<hr />
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h6>
							<strong>Administration</strong>
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
	computed:{
		adm_grand_total(){
			var total_amount = 0;
			this.budget.forEach(center => {
				console.log("is there a center", center);
				center.adm_budget_details.forEach(detail => {
					console.log("budget year is", detail.adm_budget_year);
					total_amount+= Number(detail.adm_budget_year);
				});
			console.log("total amount is", total_amount);
		});			return total_amount;

		}
	},
	data() {
		return {};
	}
};
</script>

<style>
</style>