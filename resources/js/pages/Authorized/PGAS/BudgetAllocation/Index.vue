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
				<basic-table v-if="items!=null" :fields="fields" :items="items"></basic-table>
			</b-card-body>
		</b-card>
	</div>
</template>

<script>
import basicTable from "../../../../components/public/BasicTable";
export default {
	data() {
		return {
			items: [],
			fields: null,
			mandates: null
		};
	},
	components: {
		"basic-table": basicTable
	},
	methods: {
		loadItems() {
			axios.get("/api/budget-allocation").then(response => {
				const budgets = response.data.data;
				this.budgets = response.data.data;
				budgets.forEach(mandate => {
					this.items.push({
						id: budget.id,
						status: budget.status,
						item_params: {
							link: "budget_show",
							id: budget.id
						}
					});
				});
			});
		},
		loadFields() {
			this.fields = [
				{
					key: "id",
					label: "Budget Year",
					class: "text-center",
					sortable: true,
					sortDirection: "desc"
				},
				{
					key: "status",
					label: "Status",
					sortable: true,
					class: "text-center"
				},
				{
					key: "actions",
					label: "Actions",
					sortable: true,
					class: "text-center"
				}
			];
		}
	},
	mounted() {
		this.loadItems();
		this.loadFields();
	}
};
</script>
<style>
</style>