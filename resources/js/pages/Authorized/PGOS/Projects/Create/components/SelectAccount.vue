<template>
    <b-modal id="select-account" size="xxl" @hidden="resetModal">
        <template v-slot:modal-title>Select Account and Client</template>
        <div class="modal-body">
                <!-- Account List -->
                <account-list @account-selected="selectAccount"></account-list>
                <!-- Client List -->
                <client-list :selected_account="selected_account" @client-selected="selectClient"></client-list>
                <!-- Department Brand List -->
                <department-brand-list :selected_client="selected_client" @department-selected="selectDepartment" @brand-selected="selectBrand"></department-brand-list>
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
export default {
    data() {
        return {
            items: [],
            accounts: null,
            selected_account: null,
            selected_client: null,
            selected_department: null,
            selected_brand: null,

            account_client:null,
        };
    },
    props:{
        project: Object,
        select_account_key: Number
    },
    components: {
        "account-list": accountList,
        "client-list": clientList,
        "department-brand-list": departmentBrandList
    },
    methods:{
        selectAccount(account){
            this.selected_account = account;
        },
        selectClient(client){
            this.selected_client = client;
        },
        selectDepartment(department){
            this.selected_department = department;
        },
        selectBrand(brand){
            this.selected_brand = brand;
        },
        selectAccountClient(){
            this.project.account = {
                account_id: this.selected_account.id,
                client: this.selected_client,
                department: this.selected_department,
                brand: this.selected_brand
            };
            this.$bvModal.hide("select-account");
        },
        resetModal(){
            this.$emit('reset-select-account-client');
        }
    }
};
</script>