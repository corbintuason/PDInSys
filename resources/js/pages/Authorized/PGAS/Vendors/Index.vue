<template>
    <div>
        <b-breadcrumb class="mt-4">
            <b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
            <b-breadcrumb-item active>Vendors</b-breadcrumb-item>
        </b-breadcrumb>
        <b-card class="mt-4">
            <template v-slot:header>
                <h1 class="component-title">Vendors</h1>
            </template>
            <b-card-body>
                <basic-table
                    v-if="items != null"
                    :fields="fields"
                    :items="items"
                ></basic-table>
            </b-card-body>
        </b-card>
    </div>
</template>

<script>
import basicTable from "../../../../components/public/BasicTable";
export default {
    data() {
        return {
            items: [],
            fields: null,
            vendors: null,
        };
    },
    components: {
        "basic-table": basicTable,
    },
    methods: {
        loadItems() {
            axios.get("/api/vendor").then((response) => {
                const vendors = response.data.data;
                this.vendors = response.data.data;
                vendors.forEach((vendor) => {
                    this.items.push({
                        code: vendor.code,
                        item_name: vendor.vendor_name,
                        contact_number: vendor.contact_number,
                        status: vendor.status,
                        item_params: {
                            link: "vendor_show",
                            id: vendor.id,
                        },
                    });
                });
            });
        },
        loadFields() {
            this.fields = [
                {
                    key: "code",
                    label: "Vendor Code",
                    class: "text-center",
                    sortable: true,
                    sortDirection: "desc",
                },
                {
                    key: "item_name",
                    label: "Vendor Name",
                    sortable: true,
                    sortDirection: "desc",
                },
                {
                    key: "contact_number",
                    label: "Contact Number",
                    sortable: true,
                    sortDirection: "desc",
                },
                {
                    key: "status",
                    label: "Status",
                    sortable: true,
                    class: "text-center",
                },
            ];
        },
    },
    mounted() {
        this.loadItems();
        this.loadFields();
    },
};
</script>
