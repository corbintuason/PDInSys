<template>
    <div>
        <b-card v-if="project!=null" class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">{{ name }} for {{project}}</h1>
            </template>
            <b-card-body> </b-card-body>
        </b-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            project: null,
            name: "Cost Estimate"
        };
    },
    methods:{
        loadProject(){
            var project_id = this.$route.params.id;
            axios.get("/api/project/" + project_id).then(response => {
                this.project = response.data.data;
            });
        }
    },
    mounted(){
        this.loadProject();
    }
};
</script>
