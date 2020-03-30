<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Project List and Status</h1>
      </template>
      <basic-table v-if="items!=null" :items="items" :fields="fields"></basic-table>
      <!-- <b-button variant="outline-primary" @click="openCreateAccount"> Create Account </b-button> -->
    </b-card>
    <!-- <create-account></create-account> -->
  </div>
</template>

<script>

export default {
  data() {
    return {
      items: null,
      fields: null
    };
  },
  methods: {
    loadItems() {
      this.items = [
        {
          project_code: "19-0030",
          project_name: "GLOBE",
          status: "Awarded",
        },
      ];
    },
    loadFields() {
      this.fields = [
        {
          key: "project_code",
          label: "Project Code",
          sortable: true,
          sortDirection: "desc",
          class: "text-center"
        },
        {
          key: "project_name",
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
    openCreateAccount(){
      this.$bvModal.show('create-account');
    }
  },
  mounted() {
    this.loadItems();
    this.loadFields();
  }
};
</script>