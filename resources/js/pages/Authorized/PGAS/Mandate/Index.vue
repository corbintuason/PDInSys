<template>
  <div>
    <b-card class="mt-5">
      <template v-slot:header>
        <h1 class="component-title">Mandate</h1>
      </template>
      <b-card-body>
        <basic-table v-if="items!=null" :fields="fields" :items="items"></basic-table>
        {{mandates}}
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
      mandates: null,
    };
  },
  components:{
    "basic-table": basicTable
  },
  methods: {
    loadItems() {
      axios.get("/api/mandate").then(response => {
        const mandates = response.data.data;
        this.mandates = response.data.data;
        mandates.forEach(mandate => {
          this.items.push({
            item_name: mandate.mandate_name,
            contact_number: mandate.contact_number,
            status: mandate.status,
            item_params: {
              link: "mandate_show",
              id: mandate.id
            }
          });
        })
      });
    },
    loadFields() {
      this.fields = [
        {
          key: "item_details.name",
          label: "mandate Name",
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
