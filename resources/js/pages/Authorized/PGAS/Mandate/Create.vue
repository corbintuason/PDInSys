<template>
    <div>
        <b-breadcrumb class="mt-4">
            <b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
            <b-breadcrumb-item href="/mandates"
                >List of Manpower</b-breadcrumb-item
            >
            <b-breadcrumb-item active>Create Manpower</b-breadcrumb-item>
        </b-breadcrumb>
        <!-- Progress Bar -->

        <!-- <item-progress class="mt-3" :namespace="namespace"></item-progress> -->
        <!-- Main Mandate Form -->

        <create-mandate :namespace="namespace"></create-mandate>
    </div>
</template>

<script>
import form from "../../../../mixins/form";
import states from "../../../../mixins/states";
import createMandate from "./Create/CreateMandate";
import { mandateModule } from "../../../../store/modules/mandate";
import { mapGetters, mapState } from "vuex";

export default {
    data() {
        return {
            mode: "Create",
            namespace: "mandate-create",
            endpoints: {
                api: "/api/mandate",
                show_route: "mandate_show",
            },
        };
    },
    mixins: [form, states],
    components: {
        "create-mandate": createMandate,
    },
};
</script>
