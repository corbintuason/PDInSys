<template>
    <div>
        <div v-if="!loading">
            <!-- Progress Bar -->

            <item-progress
                class="mt-3"
                :namespace="namespace"
            ></item-progress>

            <!-- Main Project Details -->

            <show-project
                :namespace="namespace"
            ></show-project>

            <!-- Change Logs  -->
            <change-logs
               :namespace="namespace"
            ></change-logs>
        </div>
        <clip-loader v-else color="orange"></clip-loader>
    </div>
</template>

<script>
import { projectModule } from "../../../../store/modules/project";
import showProject from "./Show/ShowProject";
import states from "../../../../mixins/states";
import { mapState } from "vuex";
export default {
    data() {
        return {
            namespace: "project-" + this.$route.params.id,
        };
    },
    mixins: [states],

    components: {
        "show-project": showProject,
    },
    computed: {
        ...mapState({
            loading(state) {
                return state[this.namespace].loading;
            },
        }),
    },
    methods: {},
    beforeDestroy() {
        this.$store.unregisterModule(this.namespace);
    },
    beforeCreate() {
        var id = this.$route.params.id;
        var namespace = "project-" + id;
        return new Promise((resolve, reject) => {
            resolve(this.$store.registerModule(namespace, projectModule));
        }).then((response) => {
            this.$store.dispatch(namespace + "/storeItem", id);
        });
    },

    mounted() {
      console.log("check the stores", this.$store);
    },
};
</script>
