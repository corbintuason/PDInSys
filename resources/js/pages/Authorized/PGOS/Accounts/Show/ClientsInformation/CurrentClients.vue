<template>
  <div>
    <h1 class="component-sub-header">Current Clients</h1>
    <div class="row">
      <div class="col-md-12">  
    <b-table
      selectable
      select-mode="single"
      :items="clients"
      :fields="clients_fields"
      responsive="sm"
    >
    </b-table>
      </div>
    </div>
    <selected-client v-if="selected_client!=null" :selected_client="selected_client"></selected-client>
    <!-- <add-client :form="form" :key="add_client_key"></add-client> -->
  </div>
</template>

<script>
import addClient from "./AddClient"
import selectedClient from "./SelectedClient";
import {mapState} from "vuex";
export default {
  data() {
    return {
        namespace: "show-account",
      selected_client: null,
      add_client_key: 0,
      clients_fields:[
        "last_name", "first_name", "designation", "mobile_number", "email_address"
      ]
    };
  },
  components: {
    "selected-client": selectedClient,
    "add-client": addClient
  },
  props: {
    
  },
  watch:{
    clients(){
      this.add_client_key++;
    }
  },
  computed:{
        ...mapState({
            clients(state, getters) {
                return getters[this.namespace + "/getClients"];
            },


        }),
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