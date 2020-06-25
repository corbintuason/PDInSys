<template>
    <div>
        <strong>Journal Summary</strong>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(category, category_index) in categories"
                    :key="category_index"
                >
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
                    <!-- <td>{{getCategoryTotal(category)}}</td> -->
                </tr>
            </tbody>
        </table>
        <div class="row">
 <b-card header="Total Liquidated Amount" class="text-center col-md-4 offset-md-8">
            <b-card-text>
                <b-input-group>
                    <template v-slot:prepend>
                        <b-input-group-text
                            ><strong class="text-success"
                                >&#8369;</strong
                            ></b-input-group-text
                        >
                    </template>
                    <money disabled class="form-control" :value="total_liquidated_amount"></money>
                </b-input-group>
            </b-card-text>
        </b-card>
        </div>
       
    </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
export default {
    data() {
        return {};
    },
    computed: {
        ...mapState("show-budget-request", {
            categories: (state, getters) => getters.categories,
        }),
        ...mapState("liquidation-journal", {
            liquidation_journal: (state) => state.item,
        }),
        total_liquidated_amount(){
            var total = 0;
            this.categories.forEach(category => {
                total+=this.getCategoryTotal(category.name);
            });
            return total;
        }
    },
    methods: {
        getCategoryTotal(category) {
            console.log(category, "??");
            var category_items = this.liquidation_journal.entries.filter(
                (entry) => entry.category === category
            );
            var total = 0;
            category_items.forEach((category) => {
                total += category.gross_amount;
            });
            return total;
        },
    },
};
</script>
