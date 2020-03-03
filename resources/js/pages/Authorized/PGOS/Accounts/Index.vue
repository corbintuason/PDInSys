<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Accounts and Clients</h1>
      </template>
      <basic-table v-if="items!=null" :items="items" :fields="fields"></basic-table>
    </b-card>
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
  },
  methods: {
    loadItems() {
      this.items = [
        {
          item_name: "a",
          status: "Re-Published",
          created_at: "123",
          processed_by: "u",
          item_params: {
            link: "account_show",
            id: 5
          }
        },
        {
          item_name: "seven",
          status: "Re-Published",
          created_at: "123",
          processed_by: "u",
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
          label: "Name",
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
          key: "created_at",
          label: "Processed At",
          sortable: true,
          class: "text-center"
        },
        {
          key: "processed_by",
          label: "Processed By",
          sortable: true,
          class: "text-center"
        }
      ];
    }
  },
  mounted() {
    this.loadItems();
    this.loadFields();
  }
};
</script>