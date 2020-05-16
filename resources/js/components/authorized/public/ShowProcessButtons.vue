<template>
    <div>
        <template v-if="mode == 'Show'">
            <show-mode
                :item="item"
                :item_model="item_model"
                :action_name="action_name"
                :steps="steps"
                :endpoints="endpoints"
                :current_step="current_step"
                :namespace="namespace"
            ></show-mode>
        </template>
        <template v-else-if="mode == 'Edit'">
            <edit-mode
                :item="item"
                :item_model="item_model"
                :current_step="current_step"
                :steps="steps"
                :action_name="action_name"
                :endpoints="endpoints"
                :uploadable="uploadable"
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
export default {
    data() {
        return {
            user: this.$store.state.user,
            current_step: this.getCurrentStep(this.item, this.steps),
        };
    },
    mixins: [form, steps],
    props: {
        item: Object,
        item_model: String,
        steps: Array,
        mode: String,
        endpoints: Object,
        uploadable: Boolean,
        namespace: String
    },
    components: {
        "show-mode": showMode,
        "edit-mode": editMode,
    },
    computed: {
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
