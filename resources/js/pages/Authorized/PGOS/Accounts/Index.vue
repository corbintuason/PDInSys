<template>
  <div>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Accounts and Clients</h1>
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
      accounts: null,
    };
  },
  components:{
    "basic-table": basicTable
  },
  methods: {
    loadItems() {
      axios.get("/api/account").then(response => {
        const accounts = response.data.data;
        this.accounts = response.data.data;
        accounts.forEach(account => {
          this.items.push({
            code: account.code,
            status: account.status,
            item_params: {
              link: "account_show",
              id: account.id
            }
          });
        })
      });
    },
    loadFields() {
      this.fields = [
        {
          key: "code",
          label: "Account Code",
                    class: "text-center",
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
      console.log("hmmm??", this.$store);
        this.loadItems();
        this.loadFields();
    }
}
</script>
