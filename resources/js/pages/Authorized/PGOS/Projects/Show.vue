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
import { showProjectModule } from "../../../../store/modules/project/show";
import showProject from "./Show/ShowProject";
import states from "../../../../mixins/states";
import { mapState } from "vuex";
export default {
    data() {
        return {
            namespace: "show-project"
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
        var namespace = "show-project";
        var id = this.$route.params.id;
        return new Promise((resolve, reject) => {
            resolve(this.$store.registerModule(namespace, showProjectModule));
        }).then((response) => {
            this.$store.dispatch(namespace + "/storeItem", id);
        });
    },

    mounted() {

},
};
</script>
