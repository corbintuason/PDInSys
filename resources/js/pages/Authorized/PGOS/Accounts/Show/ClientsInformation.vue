<template>
  <div>
    <!-- Current Clients -->
    <current-clients :clients="account.clients"></current-clients>
    <!-- Selected Client -->
  </div>
</template>

<script>
import currentClients from "./ClientsInformation/CurrentClients"
import selectedClient from "./ClientsInformation/SelectedClient"
import addClient from "./ClientsInformation/AddClient"
export default {
  data() {
    return {
      active_client: null,
      clients_key: 0,
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
 
    };
  },
  components: {
    "current-clients": currentClients,
    "selected-client": selectedClient,
  },
  props: {
    account: Object
  },
  watch: {},
  methods: {
  }
};
</script>