<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Project List and Status</h1>
      </template>
      <b-card-body>
        <basic-table v-if="items!=null" :fields="fields" :items="items"></basic-table>
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
      accounts: null,
    };
  },
  components:{
    "basic-table": basicTable,
  },
  methods: {
    loadItems() {

      axios.get("/api/project").then(response => {
        const projects = response.data.data;
        this.projects = response.data.data;
        projects.forEach(account => {
          this.items.push({
            item_name: account.registered_name,
            status: account.status,
            item_params: {
              link: "project_show",
              id: account.id
            }
          });
        })
      });
    },
    loadFields() {
      this.fields = [
        {
          key: "code",
          label: "Project Code",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "name",
          label: "Project Name",
          sortable: true,
          class: "text-center"
        },
        {
          key: "status",
          label: "Project Status",
          sortable: true,
          class: "text-center"
        }

      ];
    },
},
    mounted() {
        this.loadItems();
        this.loadFields();
    }
}
</script>
