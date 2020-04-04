<template>
    <div>
        <b-card class="mt-5 table">
            <template v-slot:header>
                <h1 class="component-title">Mandate</h1>
            </template>
            <mandate-table
                class="text-center"
                v-if="items != null"
                :items="items"
                :fields="fields"
            ></mandate-table>
        </b-card>
    </div>
</template>

<script>
import mandateTable from "./Index/MandateTable";

export default {
    data() {
        return {
            items: null,
            fields: null
        };
    },
    components: {
        "mandate-table": mandateTable
    },
    methods: {
        loadItems() {
            this.items = [
                {
                    item_name: "John Doe",
                    status: "For Approval",
                    action: "",
                    item_params: {
                        link: "account_show",
                        id: 5
                    }
                }
            ];
        },
        loadFields() {
            this.fields = [
                {
                    key: "item_details.name",
                    label: "Full Name",
                    sortable: true,
                    sortDirection: "desc"
                },
                {
                    key: "status",
                    label: "Status",
                    sortable: true,
                    class: "text-center"
                },
                {
                    key: "action",
                    label: "Actions",
                    sortable: true,
                    class: "text-center"
                }
            ];
        },
        openCreateAccount() {
            this.$bvModal.show("create-account");
        }
    },
    mounted() {
        this.loadItems();
        this.loadFields();
    }
};
</script>

<style lang="scss" scoped>
.table {
    border-top: 8px solid #f7942c;
}
</style>
