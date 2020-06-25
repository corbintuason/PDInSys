<template>
	<div>
		<b-card class="mt-3"  v-if="!loading">
			<template v-slot:header>
				<h1 class="component-title">Budget Requests</h1>
			</template>
			<b-card-body>
				<basic-table v-if="items.length > 0" :fields="fields" :items="items"></basic-table>
        <b-alert v-else show variant="danger">No Budget Requests have been created</b-alert>
			</b-card-body>
            <template v-slot:footer>
                <b-button variant="outline-primary float-right" :to="{name: 'project_budget_request_create'}">Create Budget Request</b-button>
            </template>
		</b-card>       
     <clip-loader v-else></clip-loader>

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
    };
  },
  components:{
    "basic-table": basicTable,
  },
  methods: {
    loadBudgetRequests(){
        var project_id = this.$route.params.id;
        axios.get("/api/budget_request", {
          params:{
            brable_type: "App\\Project",
            brable_id: project_id
          }
        }).then(response => {
            console.log(response, "?");
          var budget_requests = response.data.data;
          this.loadFields();
          this.loadItems(budget_requests);
        })
    },
    loadItems(budget_requests) {
      budget_requests.forEach(budget_request => {
      this.items.push({
            code: budget_request.code,
            status: budget_request.status,
            item_params: {
              link: "budget_request_show",
              id: budget_request.id
            }
          });
      });
      this.loading = false;
    },
    loadFields() {
      this.fields = [
        {
          key: "code",
          label: "Budget Request Code",
          class: "text-center",
          sortable: true,
          sortDirection: "desc"
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
        this.loadBudgetRequests();
    }
}
</script>
