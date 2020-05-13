import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
export default new Vuex.Store({
    namespaced: true,
    state: {
        steps: [
            {
                name: "Create",
                responsible: "Creator",
                database_equivalent: ["Updated"],
            },
            {
                name: "Open",
                responsible: "Receiver",
                database_equivalent: ["Opened", "Updated"],
            },
        ],
    },
    getters: {},
    mutations: {},
    actions: {},
});
