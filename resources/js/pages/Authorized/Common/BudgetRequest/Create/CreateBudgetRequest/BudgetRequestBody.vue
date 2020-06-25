<template>
    <div class="row">
        <b-tabs class="col-md-12" fill>
            <b-tab
                v-for="(category, category_index) in categories"
                :key="category_index"
                :title="category.name"
            >
                <category
                    :category="category"
                    :entries="getCategoryEntries(category.name)"
                    :namespace="namespace"
                ></category>
            </b-tab>
        </b-tabs>
        <edit-entry v-if="edit_entry!=null" :namespace="namespace"></edit-entry>
    </div>
</template>

<script>
import { mapState } from "vuex";
import category from "./BudgetRequestBody/Category.vue";
import editEntry from "../../components/EditEntry"
export default {
    data() {
        return {};
    },
    components: {
        category: category,
        "edit-entry": editEntry
    },
    props: {
        namespace: String,
    },
    computed: {
        ...mapState({
            categories(state, getters) {
                return getters[this.namespace + "/categories"];
            },
            entries(state){
                return state[this.namespace].item.entries;
            },
            edit_entry(state){
                return state[this.namespace].edit_entry
            }
        }),
    },
    methods: {
        getCategoryEntries(category) {
            return this.entries.filter((entry) => entry.category == category);
        },
    },
    mounted() {
    },
};
</script>
