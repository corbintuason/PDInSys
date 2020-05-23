import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";
Vue.use(Vuex);

import auth from "./modules/auth";
import globals from "./modules/globals";
import tax from "./modules/tax";
import mandate from "./modules/mandate";
import vendor from "./modules/vendor";
import budget from "./modules/budget-allocation";
import costEstimate from "./modules/cost-estmate";
import signedCostEstimateDetails from "./modules/signed-cost-estimate-details";

export const store = new Vuex.Store({
    modules: {
        auth: auth,
        globals: globals,
        tax: tax,
        // project: project,
        // mandate: mandate,
        vendor: vendor,
        budget: budget,
        costEstimate: costEstimate,
        signedCostEstimateDetails: signedCostEstimateDetails,
    },
});
