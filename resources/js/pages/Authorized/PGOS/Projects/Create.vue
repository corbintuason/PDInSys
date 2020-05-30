<template>
    <div>
        <div v-if="!loading">
            <!-- Progress Bar -->

            <item-progress class="mt-3" :namespace="namespace"></item-progress>
            <!-- Main Project Form -->
            {{project}}
            <create-project :namespace="namespace"></create-project>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import createProject from "./Create/CreateProject";
import {projectCreateModule} from "../../../../store/modules/project-create";
import { mapGetters, mapState, mapMutations } from "vuex";

export default {
    data() {
        return {
            namespace: "project-create"
        };
    },
    methods: {
        ...mapMutations("project-create",{
            changeLoading(commit, payload) {
                return commit("changeLoading", payload);
            },
        }),
    },
    computed: {
        ...mapState("project-create",{
            project(state){
                return state.project
            },
            loading(state) {
                return state.loading;
            },
        }),
    },
    components: {
        "create-project": createProject,
    },
    beforeCreate() {
        this.$store.registerModule("project-create", projectCreateModule);
    },
    mounted() {
        console.log(this.$store);
    },
};
</script>
