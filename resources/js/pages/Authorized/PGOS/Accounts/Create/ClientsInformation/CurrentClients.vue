<template>
  <div>
    <h1 class="component-sub-header">Current Clients</h1>
    <div class="row">
      <div class="col-md-12">
        <b-list-group>
          <b-list-group-item
            href="#"
            v-for="(client, client_index) in clients"
            :key="client_index"
            class="flex-column align-items-start"
            @click="selectClient(client)"
          >
            <div class="d-flex w-100">
              <h5 class="mb-1">
                <strong>{{client.salutation}} {{client.last_name}}, {{client.first_name}}</strong>
              </h5>
            </div>
            <p class="mb-1">Birthday: {{client.birthday}}</p>
            <p class="mb-1">Designation: {{client.designation}}</p>
          </b-list-group-item>
        </b-list-group>
        <b-button variant="outline-primary" block @click="addClient">Add Client</b-button>
      </div>
    </div>
    <selected-client v-if="selected_client!=null" :selected_client="selected_client"></selected-client>
    <add-client :form="form" :key="add_client_key"></add-client>
  </div>
</template>

<script>
import addClient from "./AddClient"
import selectedClient from "./SelectedClient";
export default {
  data() {
    return {
      selected_client: null,
      add_client_key: 0,
    };
  },
  components: {
    "selected-client": selectedClient,
    "add-client": addClient
  },
  props: {
    clients: Array,
    form: Object
  },
  watch:{
    clients(){
      this.add_client_key++;
    }
  },
  methods: {
    selectClient(client) {
      return new Promise((resolve, reject) => {
          this.selected_client = client;
           resolve(client);
      }).then(() => {
          this.$bvModal.show("selected-client");
      });
    },
    addClient() {
        this.$bvModal.show("add-client");
    }
  }
};
</script>