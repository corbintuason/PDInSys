<template>
    <div>
        <template v-if="mode == 'Show'">
            <show-mode
                :namespace="namespace"
            ></show-mode>
        </template>
        <template v-else-if="mode == 'Edit'">
            <edit-mode
                :namespace="namespace"
            ></edit-mode>
        </template>
    </div>
</template>

<script>
import showMode from "./ShowProjectButtons/ShowMode";
import editMode from "./ShowProjectButtons/EditMode";
import form from "../../../mixins/form";
import steps from "../../../mixins/steps";
import {mapState, mapGetters} from "vuex";

export default {
    data() {
        return {
        };
    },
    mixins: [form, steps],
    props: {
        namespace: String
    },
    components: {
        "show-mode": showMode,
        "edit-mode": editMode,
    },
    computed: {
        ...mapState({
            user(state){
                return state["auth"].user;
            },
            mode(state){
                return state[this.namespace].mode;
            },
        }),
        ...mapGetters({
                current_step(state, getters){
                    console.log("hmmm", this.namespace);
                return getters[this.namespace +"/getCurrentStep"];
            }
        }),
        action_name() {
                return this.current_step
                    ? this.current_step.name + " " + this.item_model
                    : "awit";
        },
    },
    methods: {},
    mounted(){
        console.log("the namespace is", this.namespace);
    }
};
</script>
