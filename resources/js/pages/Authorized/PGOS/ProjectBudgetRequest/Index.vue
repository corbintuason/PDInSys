<template>
	<div>
		<b-card class="mt-3">
			<template v-slot:header>
				<h1 class="component-title">Budget Requests for Project</h1>
			</template>
			<b-card-body>
				<!-- <basic-table v-if="items!=null" :fields="fields" :items="items"></basic-table> -->
			</b-card-body>
            <template v-slot:footer>
                <b-button variant="outline-primary float-right" :to="{name: 'project_budget_request_create'}">Create Budget Request</b-button>
            </template>
		</b-card>
	</div>
</template>

<script>
import basicTable from "../../../../components/public/BasicTable"
export default {
  data() {
    return {
      items: [],
      project: null,
      fields: null,
      projects: null,
    };
  },
  components:{
    "basic-table": basicTable,
  },
  methods: {
    loadProject(){
        var project_id = this.$route.params.id;
        axios.get("/api/project/"+project_id).then(response => {
           var project = response.data.data;
           this.loadFields();
           this.loadItems(project);
        });
    },
    loadItems(project) {
      axios.get("/api/project").then(response => {
        const projects = response.data.data;
        this.projects = response.data.data;
        project.budget_requests.forEach(budget_request => {
          this.items.push({
            code: budget_request.code,
            status: budget_request.status,
            item_params: {
              link: "project_budget_request_show",
              id: budget_request.id
            }
          });
        })
      });
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
        // this.loadProject();
    }
}
</script>
