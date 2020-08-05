<template>
<div class = "row">
    <div class="col-md-12">
        <strong>Department Brand List</strong>
        <!-- If Client is Not Null -->
        <template v-if="selected_account != null">
            <div class="row">
                <div class="col-md-6">
                    <b-form-group label="Departments">
                        <b-form-radio-group
                            :value="selected_department"
                            @change="selectDepartment"
                            stacked
                        >
                        <b-form-radio v-for="(department, department_index) in selected_account.departments" :key="department_index" :value="department">{{department.name}}</b-form-radio>
                        </b-form-radio-group>
                    </b-form-group>
                </div>
                <div class="col-md-6">
                     <b-form-group label="Brands">
                         <b-form-radio-group
                            :value="selected_brand"
                            @change="selectBrand"
                            stacked
                        >
                        <b-form-radio v-for="(brand, brand_index) in selected_account.brands" :key="brand_index" :value="brand">{{brand.name}}</b-form-radio>
                        </b-form-radio-group>
                    </b-form-group>
                </div>
                {{selected_brand}}
                {{selected_department}}
            </div>
        </template>
        <!-- If Accoumt is Null -->
        <template v-else>
            <b-alert show variant="danger"
                >Please select an Account First
            </b-alert>
        </template>
    </div>
</div>
  
</template>

<script>
import {mapState, mapActions} from "vuex"
export default {
    data() {
        return {
        };
    },
    computed:{
        ...mapState("create-project", {
            selected_account: state => state.selected_account,
            selected_client: state => state.selected_client,
            selected_brand: state => state.selected_brand,
            selected_department: state => state.selected_department
        }),
        // ...mapState({
        //         selected_department: {
        //         get(){
        //             console.log("try hahahaa", state);
        //             return state => state.selected_department
        //         },
        //         set(val){
        //             console.log("am i even setting")
        //             this.$store.commit("create-project/selectDepartment", val);
        //         }
        //     },
        // })
    },
    methods: {
        ...mapActions("create-project", {
            selectDepartment(dispatch, payload){
                return dispatch("selectDepartment", payload);
            },
             selectBrand(dispatch, payload){
                 console.log("payload?", payload);
                return dispatch("selectBrand", payload);
            }
        })
    },
    mounted() {},
};
</script>
