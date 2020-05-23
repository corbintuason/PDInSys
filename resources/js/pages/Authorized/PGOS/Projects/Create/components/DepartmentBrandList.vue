<template>
<div class = "row">
    <div class="col-md-12">
        <strong>Department Brand List</strong>
        <!-- If Client is Not Null -->
        <template v-if="selected_client != null">
            <div class="row">
                <div class="col-md-6">
                    <b-form-group label="Departments">
                        <b-form-radio-group
                            v-model="selected_department"
                            stacked
                        >
                        <b-form-radio v-for="(department, department_index) in selected_client.departments" :key="department_index" :value="department.id">{{department.name}}</b-form-radio>
                        </b-form-radio-group>
                    </b-form-group>
                </div>
                <div class="col-md-6">
                     <b-form-group label="Brands">
                         <b-form-radio-group
                            v-model="selected_brand"
                            stacked
                        >
                        <b-form-radio v-for="(brand, brand_index) in selected_client.brands" :key="brand_index">{{brand.name}}</b-form-radio>
                        </b-form-radio-group>
                    </b-form-group>
                </div>
            </div>
        </template>
        <!-- If Accoumt is Null -->
        <template v-else>
            <b-alert show variant="danger"
                >Please select a Client first
            </b-alert>
        </template>
    </div>
</div>
  
</template>

<script>
export default {
    data() {
        return {
            selected_brand: null,
            selected_department: null,
        };
    },
    props: {
        selected_client: Object,
    },
    watch:{
        selected_brand(){
            this.$emit("brand-selected", this.selected_brand);
        },
        selected_department(){
            this.$emit("department-selected", this.selected_department);
        }
    },
    methods: {},
    mounted() {},
};
</script>
