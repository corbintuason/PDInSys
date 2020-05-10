import Vue from "vue";
import vendor from "../store/vendor";
export const dataBus = new Vue({
    data: {
        mode: "Show",
        show_vendor_key: 0,
        steps: vendor.state.steps,
        endpoints: {
            api: "/api/vendor/",
            show_route: "vendor_show",
        },
        vendor: null,
    },
});
