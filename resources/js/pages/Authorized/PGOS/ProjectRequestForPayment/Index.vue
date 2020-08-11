<template>
	<div>
        hi
		<b-card class="mt-3" v-if="!loading">
			<template v-slot:header>
				<h1 class="component-title">Request for Payments</h1>
			</template>
			<b-card-body>
				<basic-table v-if="items.length > 0" :fields="fields" :items="items"></basic-table>
				<b-alert v-else show variant="danger">No RFPs have been created</b-alert>
			</b-card-body>
			<template v-slot:footer>
				<b-button variant="outline-primary float-right" :to="{name: 'project_rfp_create'}">Create RFP</b-button>
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
    loadRFPs(){
        var project_id = this.$route.params.id;
        axios.get("/api/rfp", {
          params:{
            rfpable_type: "App\\Project",
            rfpable_id: project_id
          }
        }).then(response => {
            console.log(response, "?");
          var rfps = response.data.data;
          this.loadFields();
          this.loadItems(rfps);
        })
    },
    loadItems(rfps) {
      rfps.forEach(rfp => {
      this.items.push({
            code: rfp.code,
            status: rfp.status,
            item_params: {
              link: "rfp_show",
              id: rfp.id
            }
          });
      });
      this.loading = false;
    },
    loadFields() {
      this.fields = [
        {
          key: "code",
          label: "RFP Code",
          class: "text-center",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "status",
          label: "Status",
          sortable: true,
          class: "text-center"
        }
      ];
    },
},
    mounted() {
        this.loadRFPs();
    }
}
</script>
