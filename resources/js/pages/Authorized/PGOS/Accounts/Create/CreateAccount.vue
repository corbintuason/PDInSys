<template>
    <b-card class="mt-3">
      <template v-slot:header>
        <h1 class="component-title">Create Account & Client </h1>
      </template>
      <b-card-text>
        <b-tabs content-class="mt-3" fill>
          <b-tab title="Account Information" active>
            <account-information :form="item"></account-information>
          </b-tab>
          <b-tab title="Clients Information">
            <clients-information :form="item"></clients-information>
          </b-tab>
        </b-tabs>
      </b-card-text>
             <template v-slot:footer>
                <b-button variant="outline-success" class="float-right" @click="createAccount">Create Account and Clients</b-button>
      </template>
    </b-card>
</template>

<script>
import accountInformation from "./AccountInformation"
import clientsInformation from "./ClientsInformation"
import {mapState, mapActions} from "vuex" 
export default{
    data(){
        return{

        }
    },
    components:{
        "account-information": accountInformation,
        "clients-information": clientsInformation
    },
    computed:{
        ...mapState("create-account",{
            item: state => state.item 
        })
    },
    methods:{
        ...mapActions("create-account", {
            createAccount: dispatch => dispatch("createAccount")
        })
    }
}
</script>