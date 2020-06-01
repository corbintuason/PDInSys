<template>
    <div class="row">
        <b-tabs class="col-md-12" fill>
            <b-tab v-for="(category, category_index) in active_categories" :key="category_index"  :title="category.name">
                <category :category="category"></category>
            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
import {mapState} from "vuex";
import category from "./BudgetRequestBody/Category.vue"
export default{
    data(){
        return{

        }
    },
    components:{
        "category": category
    },
    computed:{
        ...mapState("show-budget-request", {
            active_categories: (state, getters) => getters.active_categories
        }),
    },
    methods:{
        renderCategory(category){
            console.log(category.entries.length);
            if(category.entries.length > 0){
                return true;
            }else{
                return false;
            }
        }
    }
}
</script>
