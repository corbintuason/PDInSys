import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";
Vue.use(Vuex);

import account from "./modules/account";
import globals from "./modules/globals";
import tax from "./modules/tax";
import project from "./modules/project";
import mandate from "./modules/mandate";
import vendor from "./modules/vendor";
import budget from "./modules/budget-allocation";
import costEstimate from "./modules/cost-estmate";
import signedCostEstimateDetails from "./modules/signed-cost-estimate-details";

export const store = new Vuex.Store({
    modules: {
        // account: account,
        globals: globals,
        tax: tax,
        project: project,
        mandate: mandate,
        vendor: vendor,
        budget: budget,
        costEstimate: costEstimate,
        signedCostEstimateDetails: signedCostEstimateDetails,
    },
    state: {
        // FOR MODULE LOG IN
        user: JSON.parse(localStorage.getItem("user")) || null,
        all_notifications: [],
        token: localStorage.getItem("access_token") || null,
    },
    getters: {
        loggedIn(state) {
            return state.token != null;
        },
        hasAbility(state) {
            return (name, entity_type) =>
                state.user.abilities.some((item) => {
                    return item.name === name && item.entity_type == entity_type
                });
        },
        hasRole(state) {
            return (role) =>
                state.user.roles.some((user_role) => {
                    return user_role.name == role;
                });
        },

        isCurrentHandler(state) {
            return (current_handler) =>
                state.user.roles.includes(current_handler);
        },
    },
    mutations: {
        pushNotification(state, notification) {
            console.log("hello");
            state.all_notifications.push(notification.notification);
        },
        storeNotifications(state, notifications) {
            state.all_notifications = notifications;
        },
        storeUser(state, user) {
            state.user = user;
        },
        retrieveToken(state, token) {
            state.token = token;
        },
        destroyToken(state) {
            state.token = null;
        },
    },
    actions: {
        storeUser(context) {
            return new Promise((resolve, reject) => {
                axios.defaults.headers.common["Authorization"] =
                    "Bearer " + context.state.token;
                axios
                    .get("/api/init")
                    .then((response) => {
                        const user = response.data;
                        localStorage.setItem("user", JSON.stringify(user));
                        context.commit("storeUser", user);
                        context.commit(
                            "storeNotifications",
                            user.notifications
                        );
                        resolve(user);
                    })
                    .catch((e) => {
                        //(e);
                        reject(e);
                    });
            });
        },
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/login", {
                        pdem_email: credentials.pdem_email,
                        password: credentials.password,
                    })
                    .then((response) => {
                        const token = response.data.access_token;
                        localStorage.setItem("access_token", token);
                        context.commit("retrieveToken", token);
                        resolve(response);
                    })
                    .catch((e) => {
                        //(e);
                        reject(e);
                    });
            });
        },
        destroyToken(context) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    axios
                        .post("/api/logout")
                        .then((response) => {
                            localStorage.removeItem("access_token");
                            localStorage.removeItem("user");
                            context.commit("destroyToken");
                            resolve(response);
                        })
                        .catch((e) => {
                            //(e);
                            localStorage.removeItem("access_token");
                            localStorage.removeItem("user");
                            context.commit("destroyToken");
                            reject(e);
                        });
                });
            }
        },
        pushNotification(context, notification) {
            context.commit("pushNotification", notification);
        },
    },
});
