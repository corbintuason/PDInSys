<template>
    <b-card
        bg-variant="dark"
        text-variant="white"
    >
        <strong>BDO Reference Number: </strong>
        <b-input-group>
            <b-input :value="budget_request.reference_number"></b-input>
        </b-input-group>
    </b-card>
</template>

<script>
import {mapState} from "vuex"
export default{
    data(){
        return{}
    },
    computed:{
        ...mapState("show-budget-request",{
            budget_request: state => state.item
        })
    }

}
</script>
