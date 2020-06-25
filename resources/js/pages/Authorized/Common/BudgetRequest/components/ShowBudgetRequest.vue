<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="d-flex">
                            <th class="col-2 text-center">Item / Particular</th>
                            <th class="col-2 text-center">Description</th>
                            <th class="col-1 text-center">Qty</th>
                            <th class="col-1 text-center">Unit</th>
                            <th class="col-2 text-left">Unit Price</th>
                            <th class="col-1 text-center">No. of Days</th>
                            <th class="col-1 text-center">No. of Venues</th>
                            <th class="col-2 text-left">Sub Amount</th>
                        </tr>
                    </thead>
                    <tbody
                        v-for="(filtered_entry,
                        filtered_entry_index) in filtered_entries"
                        :key="filtered_entry_index"
                    >
                        <tr>
                            <td class="table-warning text-center" colspan="8">
                                <div class="row">
                                    <div class="col-md-12">
                                            <strong style="font-size:20px">{{
                                                filtered_entry.category.toUpperCase()
                                            }}</strong>

                                        <span class="float-right">
                                            <b-form-group
                                                class="pb-0 mb-0 mt-0 pt-0"
                                                label-cols="4"
                                                label="TOTAL: "
                                                label-class="font-weight-bold"
                                            >
                                                <b-input-group>
                                                    <template v-slot:prepend>
                                                        <b-input-group-text
                                                            ><strong
                                                                class="text-success"
                                                                >&#8369;</strong
                                                            ></b-input-group-text
                                                        >
                                                    </template>
                                                    <money
                                                        disabled
                                                        class="form-control"
                                                        :value="
                                                            category_total(
                                                                filtered_entry
                                                            )
                                                        "
                                                    ></money>
                                                </b-input-group>
                                            </b-form-group>
                                        </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr
                            class="d-flex"
                            v-for="(entry,
                            entry_index) in filtered_entry.entries"
                            :key="entry_index"
                        >
                            <td class="col-2 text-center">
                                {{ entry.type }}
                            </td>
                            <td class="col-2 text-center">
                                {{ entry.description }}
                            </td>
                            <td class="col-1 text-center">
                                {{ entry.quantity }}
                            </td>
                            <td class="col-1 text-center">
                                {{ entry.unit }}
                            </td>
                            <td class="col-2 text-left">
                                <b-input-group size="sm">
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
                                        :value="entry.unit_price"
                                    ></money>
                                </b-input-group>
                            </td>
                            <td class="col-1 text-center">
                                {{ entry.no_of_days }}
                            </td>
                            <td class="col-1 text-center">
                                {{ entry.no_of_venues }}
                            </td>
                            <td class="col-2 text-left">
                                <b-input-group size="sm">
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
                                        :value="getSubAmount(entry)"
                                    ></money>
                                </b-input-group>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <total-budget-requested></total-budget-requested> -->
    </div>
</template>

<script>
import budgetRequestMixin from "../../../../../mixins/budget-request";
import totalBudgetRequested from "./TotalBudgetRequested";

export default {
    data() {
        return {
            filtered_entries: this.filterEntries(),
        };
    },
    props: {
        budget_request: Object,
    },
    mixins: [budgetRequestMixin],
    components: {
        "total-budget-requested": totalBudgetRequested,
    },
    methods: {
        category_total(filtered_entry) {
            var sum = 0;
            filtered_entry.entries.forEach((entry) => {
                sum += this.getSubAmount(entry);
            });
            return sum;
        },
        getSubAmount(entry) {
            return (
                entry.quantity *
                entry.unit_price *
                entry.no_of_days *
                entry.no_of_venues
            );
        },
        category_name(cateogry) {},
    },
    mounted() {
        // this.filterCategories();
    },
};
</script>
