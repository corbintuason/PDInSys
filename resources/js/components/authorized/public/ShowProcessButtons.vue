<template>
    <div>
        <template v-if="mode == 'Show'">
            <show-mode
                :item="item"
                :item_model="item_model"
                :steps="steps"
                :endpoints="endpoints"
            ></show-mode>
        </template>
        <template v-else-if="mode == 'Edit'">
            <edit-mode  
                :item="item"
                :item_model="item_model"
                :steps="steps"
                :endpoints="endpoints"></edit-mode>
        </template>
    </div>
</template>

<script>
// import returnItem from "../../../../../../components/authorized/public/ReturnItem";
import showMode from "./ShowProjectButtons/ShowMode";
import editMode from "./ShowProjectButtons/EditMode";

export default {
    data() {
        return {
            user: this.$store.state.user,
            next_step: null,
        };
    },
    props: {
        item: Object,
        item_model: String,
        steps: Array,
        mode: String,
        endpoints: Object,
    },
    components: {
        "show-mode": showMode,
        "edit-mode": editMode,
    },
};
</script>
