<template>
    <div class="row">
        <div class="col-md-12">
            <strong>Account List</strong>
            <b-table
                v-if="!loading"
                selectable
                select-mode="single"
                :items="accounts"
                :fields="fields"
                @row-selected="selectAccount($event)"
                responsive="sm"
            ></b-table>
            <clip-loader v-else color="orange"></clip-loader>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    data() {
        return {
            loading: true,
            accounts: [],
            fields: [],
        };
    },
    computed: {
        ...mapState("create-project", {
            project(state) {
                return state.project;
            },
        }),
    },
    methods: {
        ...mapActions("create-project", {
            selectAccount(dispatch, payload) {
                console.log("hi????", payload);
                return dispatch("selectAccount", payload);
            },
        }),
        loadItems() {
            axios.get("/api/account", {
                params:{
                    status: "Approved"
                }
            }).then((response) => {
                const accounts = response.data.data;
                console.log("lemme check accounts", accounts);
                accounts.forEach((account) => {
                    console.log("bakit ka dumodoble", account);
                    this.accounts.push({
                        id: account.id,
                        code: account.code,
                        registered_name: account.registered_name,
                        departments: account.departments, 
                        brands: account.brands,
                        status: account.status,
                        clients: account.clients
                    });
                });
                this.loading = false;
                console.log("??", this.loading);
                console.log("kek", this.accounts);
            });
        },
        loadFields() {
            this.fields = [
                {
                    key: "registered_name",
                    label: "Registered Name",
                    class: "text-center",
                    sortable: true,
                    sortDirection: "desc",
                },
                {
                    key: "status",
                    label: "Status",
                    sortable: true,
                    class: "text-center",
                },
            ];
        },
    },
    mounted() {
        this.loadItems();
        this.loadFields();
    },
};
</script>
