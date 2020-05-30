<template>
    <div class="row">
        <div class="col-md-12">
            <b-table striped hover :items="items" :fields="fields">
                <template v-slot:cell(requirement)="data">
                    <template v-if="hasCoreEmployee('Main Account Manager')">
                   	<router-link
					:to="{
                        name: data.item.link.name,
                        params: { id: data.item.link.id }
                    }"
				>{{ data.item.requirement}}</router-link>
                    </template>
                    <template v-else>
                        <span v-b-tooltip.hover title="Available once a Main Account Manager has been assigned">
                        {{ data.item.requirement }}

                        </span>
                    </template>

                </template>
            </b-table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [
                {
                    requirement: "Cost Estimate",
                    status: "",
                    link: {
                        name: "cost_estimate_show",
                        id: this.project.id
                    }
                }
            ],
            fields: [
                {
                    key: "requirement",
                    label: "Requirement",
                    class: "text-center",
                    sortable: true,
                    sortDirection: "desc",
                },
                {
                    key: "status",
                    label: "Status",
                    sortable: true,
                    class: "text-center",
                },
            ],
            quick_access_buttons: [
                "Cost Estimate",
                "Budget Opening",
                "Budget Request",
                "Request For Payment",
                "Project Execution Plan",
                "Job Order",
                "Supplies Requesition",
                "Vehicle Requisition",
                "Asset Movement",
            ],
        };
    },
    computed:{
    },
    props: {
        project: Object,
    },
    methods:{
        hasCoreEmployee(core_employee_type){
            return this.project.core_team.find(core_employee => core_employee.type == core_employee_type);
        
        }
    },
    mounted(){
        console.log("nasa quick ccess ako", this.project.id);
    }
};
</script>
