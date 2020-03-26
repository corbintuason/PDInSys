<template>
    <div>
        <b-card class="mt-5 table">
            <template v-slot:header>
                <h1 class="component-title">Vendors</h1>
            </template>
            <basic-table
                class="text-center"
                v-if="items != null"
                :items="items"
                :fields="fields"
            ></basic-table>
            <!-- <b-button variant="outline-primary" @click="openCreateAccount"> Create Account </b-button> -->
        </b-card>
        <!-- <create-account></create-account> -->
    </div>
</template>

<script>
import basicTable from "../../../../components/public/BasicTable";

export default {
    data() {
        return {
            items: null,
            fields: null
        };
    },
    components: {
        "basic-table": basicTable
        // "create-account": createAccount
    },
    methods: {
        loadItems() {
            this.items = [
                {
                    item_name: "ABC 123",
                    registered_address: "3390 West Vigan St Sampaloc Manila",
                    status: "For Approval",
                    action: "Edit, Delete",
                    item_params: {
                        link: "account_show",
                        id: 5
                    }
                },
                {
                    item_name: "DEF 456",
                    registered_address: "123 White St. East Capitol, Pasig",
                    status: "Approved",
                    action: "Edit, Delete",
                    item_params: {
                        link: "account_show",
                        id: 7
                    }
                }
            ];
        },
        loadFields() {
            this.fields = [
                {
                    key: "item_details.name",
                    label: "Trade Name",
                    sortable: true,
                    sortDirection: "desc"
                },
                {
                    key: "registered_address",
                    label: "Registered Address",
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
* {
    font-family: "Lato";
}
.table {
    border-top: 8px solid #f7942c;
}
</style>
