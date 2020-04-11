<template>
  <div>
    <b-card class="mt-5">
      <template v-slot:header>
        <h1 class="component-title">Vendors</h1>
      </template>
      <b-card-body>
        <basic-table v-if="items!=null" :fields="fields" :items="items"></basic-table>
        {{vendors}}
      </b-card-body>
    </b-card>
  </div>
</template>

<script>
import basicTable from "../../../../components/public/BasicTable"
export default {
  data() {
    return {
      items: [],
      fields: null,
      vendors: null,
    };
  },
  components:{
    "basic-table": basicTable
  },
  methods: {
    loadItems() {
      axios.get("/api/vendor").then(response => {
        const vendors = response.data.data;
        this.vendors = response.data.data;
        vendors.forEach(vendor => {
          this.items.push({
            item_name: vendor.vendor_name,
            contact_number: vendor.contact_number,
            status: vendor.status,
            item_params: {
              link: "vendor_show",
              id: vendor.id
            }
          });
        })
      });
    },
    loadFields() {
      this.fields = [
        {
          key: "item_details.name",
          label: "Vendor Name",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "contact_number",
          label: "Contact Number",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "status",
          label: "Status",
          sortable: true,
          class: "text-center"
        },
      ];
    },
},
    mounted() {
        this.loadItems();
        this.loadFields();
    }
}
</script>
