<template>
    <div>
        <table
        v-if="liquidation_journal.entries.length>0"
            class="table table-sm"
        >
            <thead class="table-primary">
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
                    v-for="(category, category_index) in categories"
                    :key="category_index"
                >
                    <td>{{ category_index + 1 }}</td>
                    <td>{{ category.name }}</td>
                    <td>
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-input-group-text
                                    ><strong class="text-success"
                                        >&#8369;</strong
                                    ></b-input-group-text
                                >
                            </template>
                            <money
                                disabled
                                class="form-control"
                                :value="getCategoryTotal(category.name)"
                            ></money>
                        </b-input-group>
                    </td>
                    <td>
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-input-group-text
                                    ><strong class="text-success"
                                        >&#8369;</strong
                                    ></b-input-group-text
                                >
                            </template>
                            <money
                                disabled
                                class="form-control"
                                :value="getLiquidatedAmount(category.name)"
                            ></money>
                        </b-input-group>
                    </td>
                    <td>
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-input-group-text
                                    ><strong class="text-success"
                                        >&#8369;</strong
                                    ></b-input-group-text
                                >
                            </template>
                            <money
                                disabled
                                class="form-control"
                                :value="getExcessBudget(category.name)"
                            ></money>
                        </b-input-group>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- If No Journal Entries exist -->
        <b-alert v-else show variant="danger" class="row"
            ><strong
                >No Liquidation Journal Entries have been found</strong
            ></b-alert
        >
        <hr />
        <div class="row mt-2">
            <div class="col-md-4">
                <b-card header="Total BR Amount" class="text-center">
                    <b-card-text>
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-input-group-text
                                    ><strong class="text-success"
                                        >&#8369;</strong
                                    ></b-input-group-text
                                >
                            </template>
                            <money
                                disabled
                                class="form-control"
                                :value="budget_request.total_budget_requested"
                            ></money>
                        </b-input-group>
                    </b-card-text>
                </b-card>
            </div>

            <div class="col-md-4">
                <b-card header="Total Liquidated Amount" class="text-center">
                    <b-card-text>
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-input-group-text
                                    ><strong class="text-success"
                                        >&#8369;</strong
                                    ></b-input-group-text
                                >
                            </template>
                            <money
                                disabled
                                class="form-control"
                                :value="getTotalLiquidatedAmount"
                            ></money>
                        </b-input-group>
                    </b-card-text>
                </b-card>
            </div>

            <div class="col-md-4">
                <b-card header="Total Excess Budget" class="text-center">
                    <b-card-text>
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-input-group-text
                                    ><strong class="text-success"
                                        >&#8369;</strong
                                    ></b-input-group-text
                                >
                            </template>
                            <money
                                disabled
                                class="form-control"
                                :value="getTotalExcessBudget"
                            ></money>
                        </b-input-group>
                    </b-card-text>
                </b-card>
            </div>
        </div>

        <b-button
            class="float-right"
            @click="showLiquidationJournalForm"
            variant="outline-primary"
            >Update Liq. Journal</b-button
        >
        <liquidation-journal-form></liquidation-journal-form>
    </div>
</template>

<script>
import liquidationJournalForm from "./LiquidationJournalForm";
import { mapState, mapMutations } from "vuex";
import budgetRequestMixin from "../.../../../../../../../../mixins/budget-request"
export default {
    data() {
        return {
        };
    },
    mixins:[budgetRequestMixin],
    components: {
        "liquidation-journal-form": liquidationJournalForm,
    },
    computed: {
        filtered_entries(){
            return this.filterEntries();
        },
        getTotalLiquidatedAmount(){
            var sum = 0;
            this.categories.forEach(category => {
                sum+=this.getLiquidatedAmount(category.name)
            });
            return sum;
        },
         getTotalExcessBudget(){
            var sum = 0;
            this.categories.forEach(category => {
                sum+=this.getExcessBudget(category.name)
            });
            return sum;
        },
        ...mapState("show-budget-request", {
            budget_request: (state) => state.item,
            categories: (state, getters) => getters.categories,
            // active_categories: (state, getters) => getters.active_categories,
        }),
        ...mapState("liquidation-journal", {
            liquidation_journal: (state) => state.item,
        }),
    },
    methods: {
        showLiquidationJournalForm() {
            this.$bvModal.show("liquidation-journal-form");
        },
    },
};
</script>
