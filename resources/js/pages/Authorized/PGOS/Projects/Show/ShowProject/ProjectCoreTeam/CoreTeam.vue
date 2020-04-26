<template>
    <b-card>
        <template v-slot:header> {{ team.name }} </template>
        <b-card-body>
            <div class="row">
                <div class="col-md-12">
                    <b-list-group>
                        <!-- If  -->
                        <b-list-group-item
                            v-for="(division, division_index) in team.divisions" :key="division_index"
                            @click="selectEmployee(division)"
                            :disabled="!canSelectEmployee"
                            :variant="teamVariant(division)"
                            class="clickable d-flex align-items-center"
                        >
                            <b-avatar class="mr-3"></b-avatar>
                            <span class="mr-auto" v-if="division.user==null">{{ division.name}} </span>
                            <span class="mr-auto" v-else>{{ division.user.user.last_name}}, {{division.user.user.first_name}} </span>

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
        return {
            user: this.$store.state.user
        };
    },
    props: {
        team: Object,
        project: Object
    },
    components:{
        "assign-employee": assignEmployee
    },
    computed:{
        canSelectEmployee(){
            return this.user.data.positions.some(position => position.name == this.team.can_edit);
        }
    },
    methods: {
        teamVariant(division){
            return division.user==null ? "danger": "";
        },
        selectEmployee(division) {
            division.modal_model = true;
            console.log("should have changed");
            console.log(division);
        },
    },
};
</script>
