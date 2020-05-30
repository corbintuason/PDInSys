<template>
    <div>
        <!-- <b-card class="mt-2 col-md-4 offset-md-8 text-right">
            <div class="row">
                <div class="col-md-12">
            {{ category.name }} Total: <money class="form-control" disabled :value="category_total"></money>
                </div>
            </div>
        </b-card> -->
           <b-card bg-variant="dark" text-variant="white" class="col-md-4 offset-md-8 mt-2 text-right">
           <strong>{{category.name}} Total: </strong> <money disabled :value="category_total"></money>
        </b-card>
        <table class="table-sm col-md-12">
            <thead>
                <tr>
                    <th>Item / Particular</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Unit Price</th>
                    <th>No. of Days</th>
                    <th>No. of Venues</th>
                    <th>Sub Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(entry, entry_index) in category.entries"
                    :key="entry_index"
                >
                    <td>
                        <b-form-select v-model="entry.item" size="sm">
                            <b-form-select-option
                                v-for="(type, type_index) in category.types"
                                :key="type_index"
                                :value="type"
                                >{{ type }}</b-form-select-option
                            >
                        </b-form-select>
                    </td>
                    <td>
                        <b-form-input v-model="entry.description" size="sm">
                        </b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            v-model="entry.quantity"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-select v-model="entry.unit" size="sm">
                            <b-form-select-option
                                v-for="(unit, unit_index) in units"
                                :key="unit_index"
                                :value="unit"
                                >{{ unit }}</b-form-select-option
                            >
                        </b-form-select>
                    </td>
                    <td>
                        <b-form-input
                            v-model="entry.unit_price"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            v-model="entry.no_of_days"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            v-model="entry.no_of_venues"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td>
                        <money
                            style="height: 30px;"
                            :value="getSubAmount(entry)"
                            disabled
                        ></money>
                    </td>
                    <!-- <td>
                        <money style="height: 30px;" :value="0.00" disabled></money>
                    </td> -->
                    <td v-if="entry_index > 0">
                        <b-button
                            variant="outline-danger"
                            @click="deleteEntry(category, entry_index)"
                            size="sm"
                            ><i class="fas fa-trash"></i
                        ></b-button>
                    </td>
                </tr>
            </tbody>
        </table>
        <b-button variant="outline-primary" @click="addEntry(category)" block>
            Add Entry
        </b-button>
    </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
    data() {
        return {};
    },
    props: {
        category: Object,
    },
    computed: {
        ...mapState("create-budget-request", {
            units: (state) => state.units,
        }),
        category_total() {
            var sum = 0;
            this.category.entries.forEach((entry) => {
                sum += this.getSubAmount(entry);
            });
            return sum;
        },
    },
    methods: {
        ...mapMutations("create-budget-request", {
            addEntry: (commit, category) => {
                return commit("addEntry", category);
            },
            deleteEntry: (commit, category, entry_index) => {
                console.log("category???");
                console.log(category);
                console.log("entry index??", entry_index);

                return commit("deleteEntry", {category, entry_index});
            },
        }),
        getSubAmount(entry) {
            return (
                entry.quantity *
                entry.unit_price *
                entry.no_of_days *
                entry.no_of_venues
            );
        },
    },
};
</script>
