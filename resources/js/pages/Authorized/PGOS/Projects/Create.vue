<template>
    <div>
        <div v-if="!loading">
            <!-- Progress Bar -->

            <item-progress class="mt-3" :namespace="namespace"></item-progress>
            <!-- Main Project Form -->

            <create-project :namespace="namespace"></create-project>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import createProject from "./Create/CreateProject";
import {projectModule} from "../../../../store/modules/project";
import { mapGetters, mapState, mapMutations } from "vuex";

export default {
    data() {
        return {
            namespace: "project-create",
        };
    },
    methods: {
        ...mapMutations({
            changeLoading(commit, payload) {
                return commit(this.namespace + "/changeLoading", payload);
            },
            changeMode(commit, payload) {
                return commit(this.namespace + "/changeMode", payload);
            },
        }),
    },
    computed: {
        ...mapState({
            loading(state) {
                return state[this.namespace].loading;
            },
        }),
    },
    components: {
        "create-project": createProject,
    },
    beforeCreate() {
        this.$store.registerModule("project-create", projectModule);
    },
    mounted() {
        this.changeLoading(false);
        this.changeMode("Create");
    },
};
</script>
