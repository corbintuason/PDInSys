<template>
    <div class="row">
        <b-card bg-variant="success" text-variant="white" class="col-md-4 offset-md-8">
           <strong>Total Budget Requested: </strong>      <b-input-group>
                <template v-slot:prepend>
                    <b-input-group-text
                        ><strong class="text-success"
                            >&#8369;</strong
                        ></b-input-group-text
                    >
                </template>
                <money disabled class="form-control" :value="getTotalBudgetRequest"></money>
            </b-input-group>
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
