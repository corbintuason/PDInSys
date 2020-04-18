<template>
	<div>
		<b-breadcrumb class="mt-4">
			<b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
			<b-breadcrumb-item active>Mandates</b-breadcrumb-item>
		</b-breadcrumb>
		<b-card class="mt-4">
			<template v-slot:header>
				<h1 class="component-title">Mandates</h1>
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
            item_name: mandate.full_name.first_name + ' ' +mandate.full_name.last_name,
            contact_number: mandate.mobile_number,
            status: mandate.status,
            action: mandate.actions,
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
          label: "Full Name",
          sortable: true,
          sortDirection: "desc",
          class: "text-center"
        },
        {
          key: "contact_number",
          label: "Contact Number",
          sortable: true,
          sortDirection: "desc",
          class: "text-center"
        },
        {
          key: "status",
          label: "Status",
          sortable: true,
          class: "text-center"
        },
        {
          key: "actions",
          label: "Actions",
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
