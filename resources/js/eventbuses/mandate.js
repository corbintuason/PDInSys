import Vue from "vue";
import mandate from "../store/mandate";
export const dataBus = new Vue({
    data: {
        mode: "Show",
        show_mandate_key: 0,
        steps: mandate.state.steps,
        endpoints: {
            api: "/api/mandate/",
            show_route: "mandate_show",
        },
        mandate: null,
    },
});
