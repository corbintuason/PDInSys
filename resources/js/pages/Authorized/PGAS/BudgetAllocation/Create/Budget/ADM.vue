<template>
	<div>
		<div class="adm">
			<b-card>
				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<h6>
							<strong>₱</strong>
							{{budget.adm_grand_total}}
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
		budget: Object
	},
	data() {
		return {};
	}
};
</script>

<style>
</style>