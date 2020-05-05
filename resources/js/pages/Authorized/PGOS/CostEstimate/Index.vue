<template>
    <div>
        <!-- Item Progress -->
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
        <!-- Cost Estiamtes -->
    </div>
</template>
<script>
import basicTable from "../../../../components/public/BasicTable"
export default {
    data() {
        return {
            mode: "Create",
            steps: this.$store.state.costEstimate.steps,
            project: null,
        };
    },
    components: {
        "basic-table": basicTable
    },
    methods: {
        loadProject() {
            var project_id = this.$route.params.id;
            axios.get("/api/project/" + project_id).then((response) => {
                this.project = response.data.data;
                console.log("awuu", this.project);
                this.cost_estimate =
                    response.data.data.relationships.cost_estimate;
            });
        },
    },

    mounted() {
        this.loadProject();
    },
};
</script>
