<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Budget Category</th>
                    <th>Budget Allotment</th>
                    <th>Liquidated Amount</th>
                    <th>Excess Budget</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(category, category_index) in active_categories"
                    :key="category_index"
                >
                    <td></td>
                    <td>{{ category.name }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <b-button @click="showLiquidationJournalModal(true)" variant="outline-primary">Update Liq. Journal</b-button>
        
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {};
    },
    computed: {
        ...mapState("show-budget-request", {
            active_categories: (state, getters) => getters.active_categories,
        }),
    },
    methods:{
        ...mapMutations("show-budget-request", {
                  showLiquidationJournalModal(commit, show){
                return commit("showLiquidationJournalModal", show);
            }
        })
    }
};
</script>
