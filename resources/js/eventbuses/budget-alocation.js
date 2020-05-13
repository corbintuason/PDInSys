import Vue from "vue";
import budget from "../store/budget-allocation";
export const dataBus = new Vue({
    data: {
        mode: "Show",
        show_budget_key: 0,
        steps: budget.state.steps,
        endpoints: {
            api: "/api/budget/",
            show_route: "budget_show",
        },
        budget: null,
    },
});
