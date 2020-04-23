<template>
    <div>
        <!-- Accts and Biz Dev and Proj. Execution -->
        <div v-for="(team, team_index) in teams" :key="team_index">
            <div class="row mt-3">
                <div class="col-md-6">
                    <core-team :team="team" :project="project"> </core-team>
                </div>
            </div>
        </div>

        <!-- Copy and Digital and Design and Multimedia -->
    </div>
</template>

<script>

import coreTeam from "./ProjectCoreTeam/CoreTeam";
export default {
    data() {
        return {
            teams: [
                {
                    name: "Accounts and Business Development Team",
                    divisions: [
                        {
                            name: "Main Account Manager",
                            modal_model: false,
                        },
                        {
                            name: "Deputy Account Manager",
                            modal_model: false,
                        },
                    ],
                    assignables: [
                        "AVP For Sales & Operations",
                        "Sales and Operations Director",
                        "Head of Accounts & Biz Development",
                        "Associate Head - ABD",
                        "Sr. Account Manager",
                        "Account Manager",
                    ],
                },
                {
                    name: "Project Execution Team",
                    divisions: [
                        {
                            name: "Main Project Manager",
                            modal_model: false,
                        },
                        {
                            name: "Deputy Project Manager",
                            modal_model: false,
                        },
                    ],
                        assignables: [
                        "President, CEO",
                    ],
                },
                {
                    name: "Copy and Digital Team",
                    divisions: [
                        {
                            name: "Main Creative Writer",
                            modal_model: false,
                        },
                        {
                            name: "Deputy Creative Writer",
                            modal_model: false,
                        },
                    ],
                        assignables: [
                        "President, CEO",
                    ],
                },
                {
                    name: "Design and Multimedia Team",
                    divisions: [
                        {
                            name: "Main Graphic Artist",
                            modal_model: false,
                        },
                        {
                            name: "Deputy Graphic Artist",
                            modal_model: false,
                        },
                    ],
                        assignables: [
                        "President, CEO",
                    ],
                },
            ],
        };
    },
    components: {
        "core-team": coreTeam,
    },
    props: {
        project: Object,
    },
};
</script>
