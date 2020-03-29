<template>
    <div>
        <b-card class="mt-5 table">
            <template v-slot:header>
                <h1 class="component-title">Vendors</h1>
            </template>
            <vendor-table
                class="text-center"
                v-if="items != null"
                :items="items"
                :fields="fields"
            ></vendor-table>
        </b-card>
    </div>
</template>

<script>
// import basicTable from "../../../../components/public/BasicTable";
import vendorTable from "./Index/VendorTable";

export default {
    data() {
        return {
            items: null,
            fields: null
        };
    },
    components: {
        "vendor-table": vendorTable
    },
    methods: {
        loadItems() {
            this.items = [
                {
                    item_name: "ABC 123",
                    registered_address: "3390 West Vigan St Sampaloc Manila",
                    status: "For Approval",
                    action: "",
                    item_params: {
                        link: "account_show",
                        id: 5
                    }
                },
                {
                    item_name: "DEF 456",
                    registered_address: "123 White St. East Capitol, Pasig",
                    status: "Approved",
                    action: "",
                    item_params: {
                        link: "account_show",
                        id: 7
                    }
                },
                {
                    item_name: "HIJ 789",
                    registered_address: "457 Black St. Mandaluyong",
                    status: "For Approval",
                    action: "",
                    item_params: {
                        link: "account_show",
                        id: 6
                    }
                },
                {
                    item_name: "KLM 123",
                    registered_address: "1776 Red St. San Juan City",
                    status: "For Revision",
                    action: "",
                    item_params: {
                        link: "account_show",
                        id: 2
                    }
                },
                {
                    item_name: "NOP 456",
                    registered_address: "412 Blue St. Cavite City",
                    status: "Approved",
                    action: "",
                    item_params: {
                        link: "account_show",
                        id: 3
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
