import Vue from 'vue';
import Vuex from 'vuex';

import axios from "axios";
Vue.use(Vuex);
import globals from "./globals"
export const store = new Vuex.Store({
    modules: {
        globals: globals
    },
    state: {
        // FOR MODULE LOG IN
        user: JSON.parse(localStorage.getItem('user')) || null,
        token: localStorage.getItem('access_token') || null,

        
    },
    getters: {
        loggedIn(state) {
            return state.token != null;
        },
        user(state) {
            return state.user;
        }

    },
    mutations: {
        storeUser(state, user) {
            state.user = user;
        },
        retrieveToken(state, token) {
            state.token = token;
        },
        destroyToken(state) {
            state.token = null;
        }
    },
    actions: {
        storeUser(context) {
            return new Promise((resolve, reject) => {
                axios.defaults.headers.common['Authorization'] = "Bearer " + context.state.token;
                axios.get("/api/init").then(response => {
                    const user = response.data;
                    console.log("testing");
                    console.log(response);
                    localStorage.setItem('user', JSON.stringify(user));
                    context.commit('storeUser', user);
                    resolve(user);
                }).catch(e => {
                    //(e);
                    reject(e);
                })
            });
        },
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post("/api/login", {
                    pdem_email: credentials.pdem_email,
                    password: credentials.password
                }).then(response => {
                    const token = response.data.access_token;
                    localStorage.setItem('access_token', token);
                    context.commit('retrieveToken', token);
                    resolve(response);
                }).catch(e => {
                    //(e);
                    reject(e);
                })
            });
        },
        destroyToken(context) {
            axios.defaults.headers.common['Authorization'] = "Bearer " + context.state.token;
            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    axios.post('/api/logout').then(response => {
                        localStorage.removeItem('access_token');
                        localStorage.removeItem('user');
                        context.commit('destroyToken');
                        resolve(response);
                    }).catch(e => {
                        //(e);
                        localStorage.removeItem('access_token');
                        localStorage.removeItem('user');
                        context.commit('destroyToken');
                        reject(e);
                    })
                });
            }
        }
    }
});