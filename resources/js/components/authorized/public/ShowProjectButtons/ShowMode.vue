<template>
    <b-button-group v-if="current_step != null && hasRole" class="float-right">
        <b-button
            @click="changeShowRejectModal"
            class="float-right"
            variant="outline-danger"
            >Reject {{ name }}</b-button
        >

        <!-- Edit Project -->
        <b-button
            @click="editButton"
            class="float-right"
            variant="outline-dark"
            >Edit {{ name }}</b-button
        >
        <b-button
            @click="changeShowReturnModal"
            variant="outline-dark"
            >Return {{ name }}</b-button
        >
        <b-button
            @click="updateStatus"
            variant="outline-success"
            >{{current_step.name}} {{name}}</b-button
        >

        <return-item :namespace="namespace"></return-item>
        <reject-item :namespace="namespace"></reject-item>
    </b-button-group>
</template>

<script>
import form from "../../../../mixins/form";
import steps from "../../../../mixins/steps";
import returnItem from "../ReturnItem";
import rejectItem from "../RejectItem";
import { mapMutations, mapState } from "vuex";
export default {
    data() {
        return {
        };
    },
    props: {
        namespace: String,
    },
    mixins: [form, steps],
    components: {
        "return-item": returnItem,
        "reject-item": rejectItem,
    },
    computed: {
        ...mapState({
            user(state){
                return state["auth"].user;
            },
            name(state) {
                return state[this.namespace].name;
            },
            item(state) {
                return state[this.namespace].item;
            },
            steps(state, getters) {
                return state[this.namespace].steps;
            },
            mode(state, getters) {
                return state[this.namespace].mode;
            },
            endpoints(state, getters) {
                return getters[this.namespace + "/getEndpoints"];
            },
            current_step(state, getters) {
                return getters[this.namespace + "/getCurrentStep"];
            },
            hasRole(state, getters){
                console.log("step", this.current_step);
                console.log(this.item.current_handler, "The handler");
                return getters["auth/hasRole"](this.item.current_handler);
            }
        }),
        // showUpdateButton() {
        //     return this.$store.getters.hasRole(this.item.current_handler);
        // },
        // showEditButton() {
        //     // Check first if user can edit in the first place, check if now is the time to edit
        //     return this.$store.getters.hasRole(this.item.current_handler);
        // },
        // showRejectButton() {
        //     // Check first if user can edit in the first place, check if now is the time to reject
        //     return this.$store.getters.hasRole(this.item.current_handler);
        // },
        // showReturnButton() {
        //     return this.$store.getters.hasRole(this.item.current_handler);
        // },
    },
    methods: {
        ...mapMutations({
            changeMode(commit, payload) {
                return commit(this.namespace + "/changeMode", "Edit");
            },
            changeShowReturnModal(commit, payload) {
                return commit(this.namespace + "/changeShowReturnModal", true);
            },
            changeShowRejectModal(commit, payload) {
                return commit(this.namespace + "/changeShowRejectModal", true);
            },
        }),
        updateStatus() {
            var swal_html = this.loadSwalContents(
                this.steps,
                this.user,
                this.item
            );
            const swal_object = {
                title: this.current_step.name + " " + this.item.code,
                html: swal_html,
                confirmButtonText: this.current_step.name,
                endpoints: this.endpoints,
            };
            this.fireUpdateSwal(swal_object, this.item);
        },

        editButton() {
            swal.fire({
                title: "Would you like to switch to Edit Mode?",
                icon: "question",
                confirmButtonText: "Edit",
            }).then((result) => {
                if (result.value) {
                    //(result);
                    swal.fire({
                        title: "Successfully switched to Edit Mode",
                        icon: "success",
                        onClose: () => {
                            this.changeMode();
                        },
                    });
                }
            });
        },
        rejectButton() {},

        returnItem() {},
    },
    mounted() {
        console.log("what did i receive", this.namespace);
        console.log(this.current_step);
    },
};
</script>
