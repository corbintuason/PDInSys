<template>
	<div v-if="budget!=null">
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item href="/budget-allocation">List of budgets</b-breadcrumb-item>
			<b-breadcrumb-item active>{{ budget.code }}</b-breadcrumb-item>
		</b-breadcrumb>
		<!-- <div>
			<item-progress class="mt-3" v-if="budget!=null" :steps="steps" :item="budget" :mode="mode"></item-progress>
		</div>-->

		<!-- Mandate -->
		<budget-allocation
			v-if="budget != null"
			:budget_code="budget.code"
			:endpoints="endpoints"
			:budget="budget"
			:mode="mode"
			:key="show_budget_key"
			:steps="steps"
		></budget-allocation>
		<!-- {{budget}} -->
		<!-- Change Logs -->
		<change-logs v-if="budget!=null" :logs="budget.actions"></change-logs>
	</div>
</template>

<script>
import budgetAllocation from "./BudgetAllocation";
import changeLogs from "../../../../components/public/ChangeLogs";
export default {
	data() {
		return {
			mode: "Show",
			show_budget_key: 0,
			steps: this.$store.state.budget.steps,
			endpoints: {
				api: "/api/budget-allocation/",
				show_route: "budget_show"
			},
			budget: null
		};
	},
	components: {
		"budget-allocation": budgetAllocation,
		"change-logs": changeLogs
	},
	watch: {
		mode() {
			this.show_budget_key++;
		}
	},
	methods: {
		loadBudget() {
			var budget_id = this.$route.params.id;
			axios.get("/api/budget-allocation/" + budget_id).then(response => {
				this.budget = response.data.data;
			});
		}
	},
	mounted() {
		this.loadBudget();
		Fire.$on("switch-mode", mode => {
			if (mode == "Show") {
				this.loadBudget();
			}
			this.mode = mode;
		});
	}
};
</script>

<style></style>
