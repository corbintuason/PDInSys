<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">ERFPs</h1>
      </template>
      <b-card-body>
        <basic-table v-if="loading!=true" :fields="fields" :items="items"></basic-table>
        <clip-loader color="orange" v-else></clip-loader>
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
      loading: true,
      fields: null,
      erfps: null,
    };
  },
  components:{
    "basic-table": basicTable
  },
  methods: {
    loadItems() {
      axios.get("/api/erfp").then(response => {
        const erfps = response.data.data;
        this.erfps = response.data.data;
        erfps.forEach(erfp => {
          this.items.push({
            code: erfp.code,
            status: erfp.status,
            item_params: {
              link: "rfp_show",
              id: erfp.id
            }
          });
        }); this.loading = false;
      });
    },
    loadFields() {
      this.fields = [
        {
          key: "code",
          label: "ERFP Code",
                    class: "text-center",
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
      console.log("hmmm??", this.$store);
        this.loadItems();
        this.loadFields();
    }
}
</script>
