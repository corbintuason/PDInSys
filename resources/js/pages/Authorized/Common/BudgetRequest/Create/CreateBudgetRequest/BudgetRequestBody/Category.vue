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
                <tr class="d-flex">
                    <th class="col-1">Item / Particular</th>
                    <th class="col-2">Description</th>
                    <th class="col-1">Qty</th>
                    <th class="col-1">Unit</th>
                    <th class="col-2">Unit Price</th>
                    <th class="col-1">No. of Days</th>
                    <th class="col-1">No. of Venues</th>
                    <th class="col-2">Sub Amount</th>
                    <th class="col-1"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="d-flex" v-for="(entry, entry_index) in entries" :key="entry_index">
                    <td class="col-1">
                        <b-form-select v-model="entry.type" size="sm" disabled>
                            <b-form-select-option
                                v-for="(type, type_index) in category.types"
                                :key="type_index"
                                :value="type"
                                >{{ type }}</b-form-select-option
                            >
                        </b-form-select>
                    </td>
                    <td class="col-2">
                        <b-form-input v-model="entry.description" disabled size="sm">
                        </b-form-input>
                    </td>
                    <td class="col-1">
                        <b-form-input
                        disabled
                            v-model="entry.quantity"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td class="col-1">
                        <b-form-select v-model="entry.unit" size="sm" disabled>
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
                            disabled
                                class="form-control"
                                v-model="entry.unit_price"
                            ></money>
                        </b-input-group>
                    </td>
                    <td class="col-1">
                        <b-form-input
                        disabled
                            v-model="entry.no_of_days"
                            size="sm"
                            type="number"
                        ></b-form-input>
                    </td>
                    <td class="col-1">
                        <b-form-input
                        disabled
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
                    <td class="col-1">
                            <b-button
                            @click="editEntry(category, entry)"
                            size="sm"
                            variant="outline-primary"
                            ><i class="fas fa-edit"></i></b-button>
                        <b-button
                            variant="outline-danger"
                            @click="deleteEntry(category.name, entry_index)"
                            size="sm"
                            ><i class="fas fa-trash"></i
                        ></b-button>
                    </td>
                </tr>
            </tbody>
        </table>
        <b-button
            variant="outline-primary"
            @click="addEntry(category.name)"
            block
        >
            Add Entry
        </b-button>
        <add-entry :category="category" :namespace="namespace"></add-entry>
    </div>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
import addEntry from "./Category/AddEntry";
export default {
    data() {
        return {
            entry: null,
                new_entry: {
                category: this.category.name
            },
        };
    },
    props: {
        category: Object,
        entries: Array,
        category_index: Number,
        namespace: String,
    },
    components:{
        "add-entry": addEntry,
    },
    computed: {
        ...mapState({
            units(state, getters){
                console.log("namespace is");
                console.log(this.namespace);
                return getters[this.namespace + "/units"];
            },
        }),
        category_total() {
            var sum = 0;
            this.entries.forEach((entry) => {
                sum += this.getSubAmount(entry);
            });
            return sum;
        },
    },
    methods: {
        ...mapMutations({
            deleteEntry(commit, category, entry_index){
                return commit(this.namespace+"/deleteEntry", { category, entry_index });
            },
            setEditEntry(commit, category, entry){
                return commit(this.namespace+"/setEditEntry", {category, entry});
            }
        }),
        ...mapActions({
            editEntry(commit, entry){
                return dispatch(this.namespace+"/editEntry", entry);
            }
        }),
        editEntry(category, entry){
            console.log(entry);
            this.setEditEntry(category, entry);
            this.$bvModal.show("edit-entry");
        },
        addEntry(){
            var entry = this.new_entry;
            this.entry = entry;
            this.$bvModal.show("add-entry-modal-"+this.category.name);
        },
        getSubAmount(entry) {
            return (
                entry.quantity *
                entry.unit_price *
                entry.no_of_days *
                entry.no_of_venues
            );
        },
    },
    mounted(){
        console.log("namespace??", this.namespace);
    }
};
</script>
