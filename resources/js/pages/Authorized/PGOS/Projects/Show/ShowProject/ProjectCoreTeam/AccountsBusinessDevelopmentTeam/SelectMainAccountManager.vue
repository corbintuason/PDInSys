<template>
    <b-modal id="select-main-account-manager" size="xl">
        <template v-slot:modal-title> Select Main Account Manager </template>
        <b-card-body>
            <b-table
                selectable
                select-mode="single"
                :items="available_employees"
                :fields="fields"
                @row-selected="selectEmployee($event)"
                responsive="sm"
            >
                <!-- Example scoped slot for select state illustrative purposes -->
                <template v-slot:cell(positions)="user">
                    <p
                        v-for="(position, position_index) in user.item
                            .positions"
                        :key="position_index"
                    >
                        {{ position.name }}
                    </p>
                </template>
            </b-table>

            <div class="row mt-2">
                <div class="col-md-12">
                    <b-alert
                        show
                        variant="danger"
                        v-if="selected_employee.employee == null"
                        >No Employee has Been Selected</b-alert
                    >
                    <b-list-group-item
                        v-else
                        class="clickable d-flex align-items-center"
                    >
                        <b-avatar class="mr-3"></b-avatar>
                        <span class="mr-auto"
                            >{{ selected_employee.employee.last_name }},
                            {{ selected_employee.employee.first_name }}
                        </span>
                        <span
                            ><strong
                                >Please select Project Score Percentage:
                            </strong>
                            <b-form-group>
                                <b-form-radio-group
                                    v-model="selected_employee.score_percentage"
                                    :options="score_percentages"
                                    name="radio-options"
                                ></b-form-radio-group>
                            </b-form-group>
                        </span>
                    </b-list-group-item>
                </div>
                {{ selected_employee }}
            </div>
        </b-card-body>
        <template v-slot:modal-footer>
            <b-button
                variant="outline-success"
                @click="assignManager"
                :disabled="canAssignManager"
                >Assign Main Account Manager</b-button
            >
        </template>
    </b-modal>
</template>

<script>
import basicTable from "../../../../../../../../components/public/BasicTable";
export default {
    data() {
        return {
            fields: [
                {
                    key: "last_name",
                    label: "Last Name",
                    sortable: true,
                },
                {
                    key: "first_name",
                    label: "First Name",
                    sortable: false,
                },
                {
                    key: "positions",
                    label: "Positions",
                    sortable: true,
                },
                {
                    key: "current_score",
                    label: "Current Score",
                    sortable: true,
                },
                {
                    key: "total_score",
                    label: "Total Score",
                    sortable: true,
                },
            ],
            score_percentages: [
                { text: "100%", value: 1 },
                { text: "75%", value: 0.75 },
                { text: "50%", value: 0.5 },
                { text: "25%", value: 0.25 },
                { text: "0%", value: 0 },
            ],
            available_employees: [],
            selected_employee: {
                employee: null,
                score_percentage: null,
            },
        };
    },
    props: {
        project: Object,
    },
    components: {
        "basic-table": basicTable,
    },
    computed: {
        canAssignManager() {
            return (
                this.selected_employee.employee == null ||
                this.selected_employee.score_percentage == null
            );
        },
    },
    methods: {
        selectEmployee(employee) {
            this.selected_employee.employee = employee[0];
        },
        assignManager() {
            swal.fire({
                title: "Assign Project Core Employee",
                icon: "question",
                text: "Please make sure you selected the right employee",
                confirmButtonText: "Assign Employee",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        var employee = {
                            project_id: this.project.id,
                            user_id: this.selected_employee.employee.id,
                            type: "Main Account Manager",
                            score_percentage: this.selected_employee.score_percentage,
                        };
                        axios
                            .post("/api/project_core_employee", employee)
                            .then((response) => {
                                resolve(response.data);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to assign core employee`
                                );
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    swal.fire({
                        title: "Employee Successfully Assigned",
                        icon: "success",
                        timer: "2500",
                        onClose: () => {
                            this.$router.go();
                        },
                    });
                }
            });
        },
        loadAvailableEmployees() {
            axios
                .get("/api/user", {
                    params: {
                        positions: [
                            "AVP For Sales & Operations",
                            "Sales and Operations Director",
                            "Head of Accounts & Biz Development",
                            "Associate Head - ABD",
                            "Sr. Account Manager",
                            "Account Manager",
                            "President, CEO",
                        ],
                    },
                })
                .then((response) => {
                    response.data.data.forEach((user) => {
                        this.available_employees.push(user);
                    });
                });
        },
    },
    mounted() {
        this.loadAvailableEmployees();
    },
};
</script>
