<template>
    <div class="row">
        <b-card :bg-variant="variant" text-variant="white" class="col-md-4 offset-md-8">
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
        ...mapState({
            getTotalBudgetRequest(state, getters){
                return getters[this.namespace +"/getTotalBudgetRequest"];
            },
            budget_limit(state, getters){
                return getters[this.namespace+"/budget_limit"];
            },
            reached_budget_limit(state, getters){
                return getters[this.namespace+"/reached_budget_limit"];
            }
        }),
        variant(){
            if(this.reached_budget_limit){
                return "danger"
            }else{
                return "success"
            }
        }
    },
    props:{
        namespace: String
    }
}
</script>
