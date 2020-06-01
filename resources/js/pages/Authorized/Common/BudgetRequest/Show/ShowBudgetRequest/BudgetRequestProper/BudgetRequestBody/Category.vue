<template>
    <div>
        <b-card
            bg-variant="dark"
            text-variant="white"
            class="col-md-4 offset-md-8 mt-2"
        >
            <strong>{{ category.name }} Total: </strong>
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
                    :value="category_total"
                ></money>
            </b-input-group>
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
                        <b-form-select
                            v-model="entry.type"
                            size="sm"
                            :disabled="mode == 'Show'"
                        >
                            <b-form-select-option
                                v-for="(type, type_index) in category.types"
                                :key="type_index"
                                :value="type"
                                >{{ type }}</b-form-select-option
                            >
                        </b-form-select>
                    </td>
                    <td>
                        <b-form-input
                            :disabled="mode == 'Show'"
                            v-model="entry.description"
                            size="sm"
                        >
                        </b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            :disabled="mode == 'Show'"
                            v-model="entry.quantity"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-select
                            v-model="entry.unit"
                            size="sm"
                            :disabled="mode == 'Show'"
                        >
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
                            :disabled="mode == 'Show'"
                            v-model="entry.unit_price"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            :disabled="mode == 'Show'"
                            v-model="entry.no_of_days"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td>
                        <b-form-input
                            :disabled="mode == 'Show'"
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
                    <td>
                        <b-button
                            v-if="mode == 'Edit'"
                            variant="outline-danger"
                            @click="deleteEntry(category, entry_index)"
                            size="sm"
                            ><i class="fas fa-trash"></i
                        ></b-button>
                    </td>
                </tr>
            </tbody>
        </table>
        <b-button
            v-if="mode == 'Edit'"
            variant="outline-primary"
            @click="addEntry(category)"
            block
        >
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
        ...mapState("show-budget-request", {
            units: (state) => state.units,
            mode: (state) => state.mode,
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
        ...mapMutations("show-budget-request", {
            addEntry: (commit, category) => {
                return commit("addEntry", category);
            },
            deleteEntry: (commit, category, entry_index) => {
                console.log("category???");
                console.log(category);
                console.log("entry index??", entry_index);

                return commit("deleteEntry", { category, entry_index });
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
