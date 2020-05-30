<template>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <b-card bg-variant="success" text-variant="white" class="col-md-4">
           <strong>Total Budget Requested: </strong> <money disabled :value="getTotalBudgetRequest"></money>
        </b-card>
    </div>
</template>

<script>
import {mapState, mapGetters} from "vuex"
export default{
    data(){
        return{}
    },
    computed:{
        ...mapGetters("create-budget-request", ["getTotalBudgetRequest"])
    }
}
</script>
