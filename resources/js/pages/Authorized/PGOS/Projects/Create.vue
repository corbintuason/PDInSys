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
import {createProjectModule} from "../../../../store/modules/project/create";
import { mapGetters, mapState, mapMutations } from "vuex";

export default {
    data() {
        return {
            namespace: "create-project"
        };
    },
    methods: {
        ...mapMutations("create-project",{
            changeLoading(commit, payload) {
                return commit("changeLoading", payload);
            },
        }),
    },
    computed: {
        ...mapState("create-project",{
            loading(state) {
                return state.loading;
            },
        }),
    },
    components: {
        "create-project": createProject,
    },
    beforeCreate() {
        this.$store.registerModule("create-project", createProjectModule);
    },
    mounted() {
        console.log(this.$store);
    },
};
</script>
