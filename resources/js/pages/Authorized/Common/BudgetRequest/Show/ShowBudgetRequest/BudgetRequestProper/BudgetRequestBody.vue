<template>
    <div class="row">
        <!-- If mode is in show -->
        <show-budget-request class="col-md-12" v-if="mode=='Show'" :budget_request="budget_request"></show-budget-request>
        <edit-budget-request class="col-md-12" v-else-if="mode=='Edit'" namespace="show-budget-request"></edit-budget-request>
        <!-- <b-tabs v-else-if="mode=='Edit'" class="col-md-12" fill>
            <b-tab
                v-for="(category, category_index) in active_categories"
                :key="category_index"
                :title="category.name"
            >
                <category
                    :category="category"
                    :entries="getCategoryEntries(category.name)"
                ></category>
            </b-tab>
        </b-tabs> -->
    </div>
</template>

<script>
import { mapState } from "vuex";
import category from "./BudgetRequestBody/Category.vue";
import showBudgetRequest from "../../../components/ShowBudgetRequest"
import editBudgetRequest from "../../../Create/CreateBudgetRequest/BudgetRequestBody"
export default {
    data() {
        return {};
    },
    components: {
        category: category,
        "show-budget-request": showBudgetRequest,
        "edit-budget-request": editBudgetRequest
    },
    computed: {
        ...mapState("show-budget-request", {
            active_categories: (state, getters) => getters.active_categories,
            mode: state => state.mode,
            budget_request: state => state.item
        }),
    },
    methods: {
        getCategoryEntries(category) {
            console.log(category, "??");
            return this.entries.filter((entry) => entry.category == category);
        },
    },
};
</script>
