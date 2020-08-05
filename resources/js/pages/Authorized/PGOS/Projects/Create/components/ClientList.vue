<template>
<div class = "row">
    <div class= "col-md-12">
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
</div>
 
</template>

<script>
import {mapState, mapActions} from "vuex";
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
    computed:{
        ...mapState("create-project", {
            selected_account(state){
                return state.selected_account;
            }
        })
    },
    methods:{
          ...mapActions("create-project", {
            selectClient(dispatch, payload) {
                console.log("hi????", payload);
                return dispatch("selectClient", payload[0]);
            },
        }),
    },
    mounted() {
    },
};
</script>
