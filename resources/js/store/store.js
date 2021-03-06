import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";
Vue.use(Vuex);

import auth from "./modules/auth";
import globals from "./modules/globals";

import tax from "./modules/tax";
import budget from "./modules/budget-allocation";
import costEstimate from "./modules/cost-estmate";
import signedCostEstimateDetails from "./modules/signed-cost-estimate-details";

import account from "./modules/account/common";
import project from "./modules/project/common";
import budgetRequest from "./modules/budget-request/common";
import liquidationJournal from "./modules/liquidation-journal/common";
import rfp from "./modules/rfp/common";

export const store = new Vuex.Store({
    modules: {
        auth: auth,
        globals: globals,
        account: account,
        project: project,
        tax: tax,
        budget: budget,
        costEstimate: costEstimate,
        signedCostEstimateDetails: signedCostEstimateDetails,
        budgetRequest: budgetRequest,
        liquidationJournal: liquidationJournal,
        rfp: rfp
    },
});
