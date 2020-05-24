<template>
    <div class="row">
        <div class="col-md-6 text-left">
            <h1 class="component-title mt-2">{{item.code}} </h1>
        </div>
        <div class="col-md-6 text-right">
            <header-buttons v-if="item.is_process_finished" :namespace="namespace"></header-buttons>
        </div>
    </div>
</template>

<script>
import headerButtons from "./ItemHeader/HeaderButtons"
import {mapState} from "vuex"
export default{
    data(){
        return{

        }
    },
    props:{
        namespace: String
    },
    computed:{
        ...mapState({
            item(state){
                return state[this.namespace].item
            }
        })
    },
    components:{
        "header-buttons": headerButtons
    }
}
</script>
