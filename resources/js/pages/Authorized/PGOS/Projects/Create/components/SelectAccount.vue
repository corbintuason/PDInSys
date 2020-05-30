<template>
    <b-modal id="select-account" size="xl" @hidden="resetModal">
        <template v-slot:modal-title>Select Account and Client</template>
        <div class="modal-body">
                <!-- Account List -->
                <account-list></account-list>
                <!-- Client List -->
                <client-list></client-list>
                <!-- Department Brand List -->
                <department-brand-list></department-brand-list>
        </div>
        <template v-slot:modal-footer>
            <b-button @click="selectAccountClient" variant="outline-success">Select Account and Client </b-button>
        </template>
    </b-modal>
</template>

<script>
import accountList from "./AccountList.vue";
import clientList from "./ClientList.vue";
import departmentBrandList from "./DepartmentBrandList.vue"
import {mapActions, mapState} from "vuex"
export default {
    data() {
        return {
            items: [],
            accounts: null,
            account_client:null,
        };
    },
    props:{
    },
    components: {
        "account-list": accountList,
        "client-list": clientList,
        "department-brand-list": departmentBrandList
    },
    computed:{
        ...mapState("project-create", {
            project: state => state.project,
            selected_client: state => state.selected_client,
            selected_department: state => state.selected_department,
            selected_brand: state => state.selected_brand
        })
    },
    methods:{
        ...mapActions("project-create", {
            resetModal(dispatch){
                return dispatch("resetModal");
            }
        }),
        selectAccountClient(){
            this.project.client_id = this.selected_client.id;
            this.project.department_id = this.selected_department.id;
            this.project.brand_id = this.selected_brand.id;
            this.$bvModal.hide("select-account");
        },
    }
};
</script>