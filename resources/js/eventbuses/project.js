import Vue from "vue";
import project from "../store/project";
export const dataBus = new Vue({
    data: {
        mode: "Show",
        show_project_key: 0,
        steps: project.state.steps,   
        endpoints: {
            api: "/api/project/",
            show_route: "project_show",
        },
        project: null,
    },
});
