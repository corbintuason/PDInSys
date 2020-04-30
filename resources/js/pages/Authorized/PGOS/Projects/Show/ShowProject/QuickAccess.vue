<template>
    <div>
        <b-card>
            <template v-slot:header>Quick Access </template>
            <template v-slot:footer>
                <b-button-group class="float-right">
                    <b-button
                        v-for="(access, access_index) in quick_access_buttons"
                        :key="access_index"
                        :to="{ name: 'cost_estimate_show', params: { id: project.id } }"
                    >
                        {{ access }}</b-button
                    >
                </b-button-group>
            </template>
        </b-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
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
    props:{
        project: Object
    }
};
</script>
