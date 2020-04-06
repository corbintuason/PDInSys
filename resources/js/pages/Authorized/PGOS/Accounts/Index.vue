<template>
  <div>
    <b-card class="mt-5">
      <template v-slot:header>
        <h1 class="component-title">Accounts and Clients</h1>
      </template>
      <b-card-body>
        <basic-table v-if="items!=null" :fields="fields" :items="items"></basic-table>
        {{accounts}}
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
      accounts: null,
    };
  },
  components:{
    "basic-table": basicTable
  },
  methods: {
    loadItems() {
      console.log("asdklfjaslkdjflkasjfl");
      axios.get("/api/account").then(response => {
        const accounts = response.data.data;
        this.accounts = response.data.data;
        accounts.forEach(account => {
          this.items.push({
            item_name: account.registered_name,
            status: account.status,
            item_params: {
              link: "account_show",
              id: account.id
            }
          });
        })
      });
      // this.items = [
      //   {
      //     item_name: "a",
      //     status: "Re-Published",
      //     item_params: {
      //       link: "account_show",
      //       id: 5
      //     }
      //   },
      //   {
      //     item_name: "seven",
      //     status: "Re-Published",
      //     item_params: {
      //       link: "account_show",
      //       id: 7
      //     }
      //   }
      // ];
    },
    loadFields() {
      this.fields = [
        {
          key: "item_details.name",
          label: "Account Name",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "status",
          label: "Status",
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
