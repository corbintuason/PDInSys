<template>
    <b-button-group class="float-right">
        <b-button variant="outline-danger" @click="discardChanges"
            >Discard Changes</b-button
        >
        <b-button variant="outline-success" @click="saveChanges">{{
            action_name
        }}</b-button>
    </b-button-group>
</template>

<script>
import form from "../../../../mixins/form";
import steps from "../../../../mixins/steps";
import { mapMutations, mapActions, mapState } from "vuex";
export default {
    data() {
        return {};
    },
    props: {
        uploadable: Boolean,
        namespace: String,
    },
    mixins: [form, steps],
    computed: {
        ...mapState({
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
            next_step(state, getters) {
                return getters[this.namespace + "/getNextStep"];
            },
        }),
        action_name() {
            return this.current_step.name + " " + this.name;
        },
    },
    methods: {
        ...mapActions({
            changeMode(dispatch, payload) {
                return dispatch(this.namespace + "/changeMode", payload);
            },
        }),
        saveChanges() {
            var swal_object = {
                title: "Save Changes to " + this.item.code + "?",
                text: "",
                confirmButtonText: "Save Changes",
                endpoints: this.endpoints,
                item: this.item,
            };
            if (this.uploadable) {
                this.fireSaveChangesWithFileSwal(swal_object);
            } else {
                console.log("am i here?");
                this.fireSaveChangesSwal(swal_object);
            }
        },
        discardChanges() {
            swal.fire({
                title: "Would you like to switch to Show Mode?",
                text: "All changes will not be saved.",
                icon: "question",
                confirmButtonText: "Discard",
            }).then((result) => {
                if (result.value) {
                    this.changeMode("Show");
                    //(result);
                    swal.fire({
                        title: "Successfully switched to Show Mode",
                        icon: "success",
                    });
                }
            });
        },
    },
    mounted() {
        console.log("ano ba yung next step", this.next_step);
    },
};
</script>
