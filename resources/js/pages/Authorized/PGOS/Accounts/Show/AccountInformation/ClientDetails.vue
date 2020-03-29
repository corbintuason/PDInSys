<template>
  <div>
    <div id="account_details">
      <h1 class="component-sub-header">Client Details</h1>
      <div class="component-sub-content">
        <div class="row">
          <div class="col-md-12">
            <basic-table :items="clients" :fields="fields"></basic-table>
            <!-- <b-button variant="outline-primary" block @click="addClientModal">Add Client</b-button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- <add-client :clients="clients" :key="add_client_index"></add-client> -->
  </div>
</template>

<script>
import form from "../../../../../mixins/form";
import basicTable from "../../../../../components/public/BasicTable";
import addClient from "../../../public/AddClientModal";
export default {
  data() {
    return {
      add_client_index:0,
      fields: [
        {
          key: "salutation",
          label: "Salutation",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "last_name",
          label: "Last Name",
          sortable: true,
          class: "text-center"
        },
        {
          key: "designation",
          label: "Designation",
          sortable: true,
          class: "text-center"
        },
        {
          key: "brand",
          label: "Brand",
          sortable: true,
          class: "text-center"
        },
        {
          key: "department",
          label: "Department",
          sortable: true,
          class: "text-center"
        },
        {
          key: "mobile_number",
          label: "Mobile Number",
          sortable: true,
          class: "text-center"
        },
        {
          key: "local_number",
          label: "Local Number",
          sortable: true,
          class: "text-center"
        },
        {
          key: "email_address",
          label: "Email Address",
          sortable: true,
          class: "text-center"
        },
        {
          key: "birthday",
          label: "Birthday",
          sortable: true,
          class: "text-center"
        }
      ],
      clients: null,
    };
  },
  props:{
    form: Object
  },
  mixins: [form],
  components: {
    "add-client": addClient,
    "basic-table": basicTable
  },
  watch:{
    clients(){
      this.add_client_index++;
      console.log("asdfasfd");
      console.log(this.add_client_index);
    }
  },
  methods: {
    loadClients(){
      var clients = [];
      this.form.departments.forEach(department => {
        department.clients.forEach(client => {
          clients.push(client);
        })
      }); 
      console.log(clients);
      this.clients=clients;
    },
    addClientModal() {
      this.$bvModal.show("add-client");
    }
  },
  mounted() {
    this.loadClients();
  }
};
</script>