import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({
    namespaced: true,
    state: {
        change_logs: null,
        vendor_code: null,
        contributors: null,
        remarks: null,
    },
    getters: {},
    mutations: {},
    actions: {},
});
