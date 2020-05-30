<template>
    <div class="row">
        <b-tabs class="col-md-12" fill>
            <b-tab v-for="(category, category_index) in categories" :key="category_index" :title="category.name">
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
        ...mapState("create-budget-request", {
            categories: state => state.categories
        })
    }
}
</script>
