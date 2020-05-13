<template>
	<div>
		<div class="annual">
			<b-card>
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h4>
							<strong>
								<b-input-group prepend="₱" class="font-weight-bold">
									<!-- <money readonly class="form-control" :value="annual_grand_total"></money> -->
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
		// annual_grand_total() {
		// }
	},
	data() {
		return {};
	}
};
</script>

<style>
</style>