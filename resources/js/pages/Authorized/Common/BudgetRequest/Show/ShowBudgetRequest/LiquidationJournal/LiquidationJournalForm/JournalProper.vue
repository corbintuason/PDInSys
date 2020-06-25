<template>
    <div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Date</th>
                    <th class="table-primary">Customer</th>
                    <th class="table-primary">Description</th>
                    <!-- <th class="table-success">Price</th> -->
                    <th class="table-primary">TIN #</th>
                    <th class="table-primary">Address Line 1</th>
                    <th class="table-primary">Address Line 2</th>
                    <th class="table-primary">Invoice / OR No.</th>
                    <th class="table-warning">Category</th>

                    <th class="table-danger">Gross Amount</th>
                    <th class="table-danger">VATable Sales</th>
                    <th class="table-danger">VAT Amount</th>
                    <th class="table-danger">VAT-Exempt Sales</th>
                    <th class="table-danger">Tag</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(entry, entry_index) in liquidation_journal.entries"
                    :key="entry_index"
                >
                    <td>
                        <b-form-datepicker
                            v-model="entry.date"
                            size="sm"
                        ></b-form-datepicker>
                    </td>
                    <td>
                        <b-form-input
                            v-model="entry.customer"
                            size="sm"
                        ></b-form-input>
                    </td>

                    <td>
                        <b-form-input
                            v-model="entry.description"
                            size="sm"
                        ></b-form-input>
                    </td>

                    <!-- <td>
                        <money v-model="entry.price"></money>
                    </td> -->

                    <td>
                        <b-form-input
                            v-model="entry.tin"
                            size="sm"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            v-model="entry.address_line_1"
                            placeholder="Street, Brgy"
                            size="sm"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            v-model="entry.address_line_2"
                            size="sm"
                            placeholder="City, Province"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            v-model="entry.invoice"
                            size="sm"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-select v-model="entry.category" size="sm">
                            <b-form-select-option
                                v-for="(category, category_index) in categories"
                                :key="category_index"
                                :value="category.name"
                                >{{ category.name }}</b-form-select-option
                            >
                        </b-form-select>
                    </td>
                    <td>
                        <b-input-group size="sm">
                            <template v-slot:prepend>
                                <b-input-group-text
                                    ><strong class="text-success"
                                        >&#8369;</strong
                                    ></b-input-group-text
                                >
                            </template>
                            <money
                                class="form-control"
                                v-model="entry.gross_amount"
                            ></money>
                        </b-input-group>
                    </td>
                    <td>
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
                                :value="getVATableSales(entry)"
                            ></money>
                        </b-input-group>
                    </td>
                    <td>
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
                                :value="getVatAmount(entry)"
                            ></money>
                        </b-input-group>
                    </td>
                    <td>
                        <b-input-group size="sm">
                            <template v-slot:prepend>
                                <b-input-group-text
                                    ><strong class="text-success"
                                        >&#8369;</strong
                                    ></b-input-group-text
                                >
                            </template>
                            <money
                                class="form-control"
                                v-model="entry.vat_exempt_sales"
                            ></money>
                        </b-input-group>
                    </td>
                    <td>
                        <b-form-select v-model="entry.tag" size="sm">
                            <b-form-select-option
                                v-for="(tag, tag_index) in tags"
                                :key="tag_index"
                                :value="tag"
                                >{{ tag }}</b-form-select-option
                            >
                        </b-form-select>
                    </td>
                    <td>
                        <b-button
                            size="sm"
                            variant="outline-danger"
                            @click="deleteEntry(entry_index)"
                        >
                            <i class="fas fa-trash"></i>
                        </b-button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <b-button
                class="col-md-12"
                variant="outline-primary"
                @click="addEntry"
                block
            >
                Add Entry
            </b-button>
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";
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
            tags: (state) => state.tags,
        }),
    },
    methods: {
        ...mapMutations("liquidation-journal", {
            addEntry: (commit, category) => {
                return commit("addEntry");
            },
            deleteEntry: (commit, entry_index) => {
                return commit("deleteEntry", entry_index);
            },
        }),
        getVATableSales(entry) {
            /**
             *  *  - If VAT (With Vat Exempt Sales)
             *         - Gross Amount minus VAT EXEMPT SALES
             *  - If Vat (w/o Vat exempt sales)
             *         - Gross Amount divided by 1.12
             *  - If Non VAT / AR
             *         - Always 0 (VAT Amount will also be 0)
             *         - VAT EXEMPT SALES = Get value of Gross Amount
             *
             *
             * */
            if (entry.tag == "VAT" && entry.vat_exempt_sales > 0) {
                console.log("first condition");
                return entry.gross_amount - entry.vat_exempt_sales;
            } else if (entry.tag == "VAT" && entry.vat_exempt_sales == 0) {
                console.log("second condition");
                return entry.gross_amount / 1.12;
            } else if (entry.tag == "Non-VAT" || entry.tag == "AR") {
                console.log("third condition");
                return 0;
            }
        },
        getVatAmount(entry) {
            return this.getVATableSales(entry) * 0.12;
        },
    },
};
</script>
