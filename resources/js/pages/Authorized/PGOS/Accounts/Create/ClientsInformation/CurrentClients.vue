<template>
    <div>
        <h1 class="component-sub-header">Current Clients</h1>
        <div class="row">
            <div class="col-md-12">
                <b-table :items="clients" :fields="clients_fields">
                    <template v-slot:cell(tools)="row">
                        <b-button
                            variant="info"
                            @click="selectClient(row)"
                            class="mr-2 text-white"
                        >
                            <i class="fas fa-pencil-alt"></i>
                        </b-button>
                        <b-button
                            variant="danger"
                            @click="deleteClient(row)"
                            class="mr-2 text-white"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </b-button>
                    </template>
                </b-table>

                <b-button variant="outline-primary" block @click="addClient"
                    >Add Client</b-button
                >
            </div>
        </div>
        <add-client :form="form" :key="add_client_key"></add-client>
        <selected-client
            v-if="selected_client != null"
            :new_client="selected_client"
            :form="form"
        ></selected-client>
    </div>
</template>

<script>
import addClient from "./AddClient";
import selectedClient from "./SelectedClient";
export default {
    data() {
        return {
            selected_client: null,
            selected_client_key: 0,
            add_client_key: 0,
            clients_fields: [
                "last_name",
                "first_name",
                "designation",
                "mobile_number",
                "email",
                "tools",
            ],
        };
    },
    components: {
        "selected-client": selectedClient,
        "add-client": addClient,
    },
    props: {
        clients: Array,
        form: Object,
    },
    watch: {
        clients() {
            this.add_client_key++;
        },
        selected_client() {
            this.selected_client_key++;
        },
    },
    methods: {
        selectClient(client) {
            this.selected_client = client.item;
            this.$bvModal.show("selected-client");
        },
        deleteClient(client) {
            this.form.clients.splice(client.index, 1);
        },
        addClient() {
            this.$bvModal.show("add-client");
        },
    },
};
</script>
