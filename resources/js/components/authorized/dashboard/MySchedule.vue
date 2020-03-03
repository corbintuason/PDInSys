<template>
  <b-card bg-variant="light" header="Light" class="text-center">
    <template v-slot:header>
      <h1 class="component-title">My Schedule</h1>
    </template>
    <b-card-body>
      <basic-table :items="items" :fields="fields"></basic-table>
    </b-card-body>
  </b-card>
</template>

<script>
import basicTable from "../../public/BasicTable"
export default {
  data() {
    return {
      items: null,
      fields: null
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