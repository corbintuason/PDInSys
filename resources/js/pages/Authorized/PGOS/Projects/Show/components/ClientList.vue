<template>
    <div class="col-md-4">
        <strong>Client List</strong>
        <!-- If Account is Not Null -->
        <template v-if="selected_account !=null ">
             <b-table :items="selected_account.clients" :fields="clients_fields" selectable select-mode="single" @row-selected="selectClient($event)">
                </b-table>
        </template>
        <!-- If Accoumt is Null -->
        <template v-else>
            <b-alert show variant="danger">Please select an Account first</b-alert>
        </template>
    </div>
</template>

<script>
export default {
    data() {
        return {
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
    props:{
        selected_account: Object
    },
    methods: {
        selectClient(client){
            this.$emit('client-selected', client[0]);
        }
    },
    mounted() {
    },
};
</script>
