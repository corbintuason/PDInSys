<template>
    <b-card>
        <template v-slot:header> {{ team.name }} </template>
        <b-card-body>
            <div class="row">
                <div class="col-md-12">
                    <b-list-group>
                        <!-- Main -->
                        <b-list-group-item
                            v-for="(division, division_index) in team.divisions" :key="division_index"
                            @click="selectEmployee(division)"
                            class="clickable d-flex align-items-center"
                        >
                            <b-avatar class="mr-3"></b-avatar>
                            <span class="mr-auto">{{ division.name}} </span>

                            <assign-employee :division="division" :team="team" :project="project"></assign-employee>
                        </b-list-group-item>
                    </b-list-group>
                </div>
            </div>
        </b-card-body>
        <!-- <select-main-account-manager :project="project"></select-main-account-manager> -->
        <!--  -->
    </b-card>
</template>

<script>
import assignEmployee from "./CoreTeam/SelectEmployeeToAssign"
// import selectMainAccountManager from "./AccountsBusinessDevelopmentTeam/SelectMainAccountManager"
export default {
    data() {
        return {};
    },
    props: {
        team: Object,
        project: Object
    },
    components:{
        "assign-employee": assignEmployee
    },
    methods: {
        selectEmployee(division) {
            console.log(division);
            division.modal_model = true;
            console.log("should have changed");
            console.log(division);
        },
    },
};
</script>
