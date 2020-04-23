<template>
    <b-card>
        <template v-slot:header> {{ name }} </template>
        <b-card-body>
            <div class="row">
                <div class ="col-md-12">
            <b-list-group>
                <!-- Main -->
                <b-list-group-item @click="selectMainAccountManager" class="clickable d-flex align-items-center">
                    <b-avatar class="mr-3"></b-avatar>
                    <span class="mr-auto">Main Account Manager </span>
                </b-list-group-item>
                <!-- Deputy -->
                <b-list-group-item class="d-flex align-items-center mt-2">
                    <b-avatar class="mr-3"></b-avatar>
                    <span class="mr-auto">Deputy Account Manager</span>
                </b-list-group-item>
            </b-list-group>
                </div>
            </div>

        </b-card-body>
        <select-main-account-manager :project="project"></select-main-account-manager>
        <!--  -->
    </b-card>
</template>

<script>
import selectMainAccountManager from "./AccountsBusinessDevelopmentTeam/SelectMainAccountManager"
export default {
    data() {
        return {
            name: "Accounts and Business Development Team",
        };
    },
    components:{
        "select-main-account-manager": selectMainAccountManager
    },
    props:{
        project: Object
    },
    computed: {},
    methods:{
        selectMainAccountManager(){
            this.$bvModal.show('select-main-account-manager');
        }
    }
};
</script>
