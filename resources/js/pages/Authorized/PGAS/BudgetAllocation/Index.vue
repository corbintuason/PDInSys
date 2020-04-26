<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item active>Budget Allocation</b-breadcrumb-item>
		</b-breadcrumb>
		<b-card class="mt-4">
			<template v-slot:header>
				<h1 class="component-title">Budget Allocation</h1>
			</template>
			<b-card-body>
				<!-- <basic-table v-if="items!=null" :fields="fields" :items="items"></basic-table> -->
			</b-card-body>
		</b-card>
	</div>
</template>

<script>
export default {

}
</script>

<style>
</style>