<template>
    <b-modal id="edit-entry" size="xl" hide-footer>
        <template v-slot:modal-header>
            Edit Entry
        </template>
        <div class="modal-body">
            <table class="table-sm col-md-12">
                <thead>
                    <tr class="d-flex">
                        <th class="col-2">Item / Particular</th>
                        <th class="col-2">Description</th>
                        <th class="col-1">Qty</th>
                        <th class="col-1">Unit</th>
                        <th class="col-2">Unit Price</th>
                        <th class="col-1">No. of Days</th>
                        <th class="col-1">No. of Venues</th>
                        <th class="col-2">Sub Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="d-flex">
                        <td class="col-2">
                            <b-form-select v-model="entry.type" size="sm">
                                <b-form-select-option
                                    v-for="(type, type_index) in category.types"
                                    :key="type_index"
                                    :value="type"
                                    >{{ type }}</b-form-select-option
                                >
                            </b-form-select>
                        </td>
                        <td class="col-2">
                            <b-form-input v-model="entry.description" size="sm">
                            </b-form-input>
                        </td>
                        <td class="col-1">
                            <b-form-input
                                v-model="entry.quantity"
                                size="sm"
                                type="number"
                            ></b-form-input>
                        </td>
                        <td class="col-1">
                            <b-form-select v-model="entry.unit" size="sm">
                                <b-form-select-option
                                    v-for="(unit, unit_index) in units"
                                    :key="unit_index"
                                    :value="unit"
                                    >{{ unit }}</b-form-select-option
                                >
                            </b-form-select>
                        </td>
                        <td class="col-2">
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
                                    v-model="entry.unit_price"
                                ></money>
                            </b-input-group>
                        </td>
                        <td class="col-1">
                            <b-form-input
                                v-model="entry.no_of_days"
                                size="sm"
                                type="number"
                            ></b-form-input>
                        </td>
                        <td class="col-1">
                            <b-form-input
                                v-model="entry.no_of_venues"
                                size="sm"
                                type="number"
                            ></b-form-input>
                        </td>
                        <td class="col-2">
                            <b-input-group size="sm">
                                <template v-slot:prepend>
                                    <b-input-group-text
                                        ><strong class="text-success"
                                            >&#8369;</strong
                                        ></b-input-group-text
                                    >
                                </template>
                                <money
                                    :value="getSubAmount(entry)"
                                    disabled
                                    class="form-control"
                                ></money>
                            </b-input-group>
                        </td>
                    </tr>
                </tbody>
            </table>
            {{ entry }}
        </div>
        <!-- <template v-slot:modal-footer>
            <b-button
                variant="outline-success"
                class="float-right"
                @click="addEntryButton(entry)"
                :disabled="disableAddEntry"
                >Save Entry</b-button
            >
        </template> -->
    </b-modal>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
    data() {
        return {

        };
    },
    props: {
        namespace: String
    },
    computed: {
        ...mapState({
            units(state, getters){
                return getters[this.namespace + "/units"]
            },
            entry(state){
                return state[this.namespace].edit_entry;
            },
            category(state){
                return state[this.namespace].edit_category
            }
        }),
        disableAddEntry() {
            if (
                this.entry.unit_price == null ||
                this.entry.type == null ||
                this.entry.description == null ||
                this.entry.quantity == null ||
                this.entry.unit == null ||
                this.entry.no_of_days == null ||
                this.entry.no_of_venues == null
            ) {
                return true;
            } else {
                return false;
            }
        },
    },
    methods: {
        ...mapMutations({
            addEntry(commit, entry){
                return commit(this.namespace +"/addEntry", entry);
            },
        }),
        addEntryButton(entry){
            this.addEntry(entry);
            this.$bvModal.hide('add-entry-modal-'+this.category.name);
        },
        getSubAmount(entry) {
            console.log("eh?");
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
