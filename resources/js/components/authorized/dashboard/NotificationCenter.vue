<template>
  <b-card class="text-center">
    <template v-slot:header>
      <h1 class="component-title">Notification Center</h1>
    </template>
    <b-card-text>
      <div class= "row">
        <div class = "col-md-12">
          <table class="table table-sm">
            <thead>
              <tr>
                <th> Project Name</th>
                                <th> Item </th>
                <th> Status </th>

              </tr>
            </thead>
          </table>
          <b-alert show variant="danger">This feature is unavailable </b-alert>
          <!-- <basic-table :fields="fields" :items="items"></basic-table> -->
        </div>
      </div>
    </b-card-text>
  </b-card>
</template>

<script>
import basicTable from "../../public/BasicTable"
export default {
  data() {
    return {
      items:[
        {
          project_name: "test",
          item: "1",
          process_status: "123",
        },
      ],
      fields:[
        {
          key: "project_name",
          label: "Project Name",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "item",
          label: "Item",
          sortable: true,
          class: "text-center"
        },
        {
          key: "process_status",
          label: "Process Status",
          sortable: true,
          class: "text-center"
        },
        {
          key: "processed_by",
          label: "Processed By",
          sortable: true,
          class: "text-center"
        }
      ]
    };
  },

  components:{
      "basic-table": basicTable
  },
  methods: {
      loadItemsFields(){
           this.items = [
        ],
        this.fields = [

        ];
      }
  },
  mounted() {
      this.loadItemsFields();
  }
};
</script>