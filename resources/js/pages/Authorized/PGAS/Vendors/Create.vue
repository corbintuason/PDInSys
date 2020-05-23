<template>
    <div>
        <b-breadcrumb class="mt-4">
            <b-breadcrumb-item href="/">Dashboard</b-breadcrumb-item>
            <b-breadcrumb-item href="/vendors"
                >List of Vendors</b-breadcrumb-item
            >
            <b-breadcrumb-item active>Create Vendor</b-breadcrumb-item>
        </b-breadcrumb>
        <!-- Progress Bar -->

        <!-- <item-progress class="mt-3" :steps="steps" :mode="mode"></item-progress> -->
        <!-- Main Vendor Form -->

        <create-vendor :namespace="namespace"></create-vendor>
    </div>
</template>

<script>
import form from "../../../../mixins/form";
import states from "../../../../mixins/states";
import createVendor from "./Create/CreateVendor";
import { vendorModule } from "../../../../store/modules/vendor";
import { mapGetters, mapState } from "vuex";

export default {
    data() {
        return {
            mode: "Create",
            namespace: "vendor-create",
            endpoints: {
                api: "/api/vendor",
                show_route: "vendor_show",
            },
        };
    },
    mixins: [form, states],
    components: {
        "create-vendor": createVendor,
    },
};
</script>
