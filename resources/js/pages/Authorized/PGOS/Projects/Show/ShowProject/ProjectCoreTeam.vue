<template>
    <div>
        <!-- Accts and Biz Dev and Proj. Execution -->
        <div
            class="row mt-2"
            v-for="(i, i_index) in Math.ceil(teams.length / 2)"
            :key="i_index"
        >
            <div
                class="col-md-6"
                v-for="(team, team_index) in teams.slice((i - 1) * 2, i * 2)"
                :key="team_index"
            >
                <core-team :team="team" :project="project"> </core-team>
            </div>
        </div>
    </div>
</template>

<script>
import coreTeam from "./ProjectCoreTeam/CoreTeam";
import {mapState} from "vuex"
export default {
    data() {
        return {
            teams: [],
            team_params: [
                {
                    name: "Accounts and Business Development Team",
                    divisions: [
                        "Main Account Manager",
                        "Deputy Account Manager",
                    ],
                    assignables: [
                        "AVP For Sales & Operations",
                        "Sales and Operations Director",
                        "Head of Accounts & Biz Development",
                        "Associate Head - ABD",
                        "Sr. Account Manager",
                        "Account Manager",
                        "VP For General Operations"
                    ],
                    can_edit: ["Head of Accounts & Biz Development"],
                },
                {
                    name: "Project Execution Team",
                    divisions: [
                        "Main Project Manager",
                        "Deputy Project Writer",
                    ],
                    assignables: ["AVP For Sales & Operations", "Sales and Operations Director", "Project Execution Head", "Associate Head - PE", "Project Manager", "Project Coordinator"],
                    can_edit: ["Project Execution Head"],
                },
                {
                    name: "Copy and Digital Team",
                    divisions: [
                        "Main Creative Writer",
                        "Deputy Creative Writer",
                    ],
                    assignables: ["Creative Director", "Associate CD - Copy and Digital", "Sr. Creative Writer"],
                    can_edit: ["Associate CD - Copy and Digital"],
                },
                {
                    name: "Design and Multimedia Team",
                    divisions: ["Main Graphic Artist", "Deputy Graphic Artist"],
                    assignables: ["Associate CD - Design and Multimedia", "Sr. Graphic Artist"],
                    can_edit: ["Associate CD - Design and Multimedia"],
                },
            ],
        };
    },
    components: {
        "core-team": coreTeam,
    },
    computed:{
        ...mapState({
            project(state){
                return state[this.namespace].item;
            }
        })
    },
    methods: {
        getUser(name, division) {
            var user = this.project.core_team.find(
                (employee) => employee.team == name && employee.type == division
            );

            return user;
        },
        loadCoreTeam() {
            this.project.departments_needed.forEach((department) => {
                this.team_params.forEach((param) => {
                    if (department.name == param.name) {
                        var team_divisions = [];
                        param.divisions.forEach((division) => {
                            team_divisions.push({
                                name: division,
                                user: this.getUser(param.name, division),
                                modal_model: false,
                            });
                        });
                        this.teams.push({
                            name: param.name,
                            divisions: team_divisions,
                            assignables: param.assignables,
                            can_edit: param.can_edit,
                        });
                    }
                });
            });
        },
    },
    props:{
        namespace: String
    },

    mounted() {
                console.log("namespace?????????");
        console.log("namespace?", this.namespace);

        this.loadCoreTeam();
    },
};
</script>
