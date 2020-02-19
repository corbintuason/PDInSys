import Vue from 'vue';
import Vuex from 'vuex';

import axios from "axios";
Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        token: localStorage.getItem('access_token') || null,
    },
    getters:{
        loggedIn(state){
            return state.token != null;
        }
    },
    mutations:{
        retrieveToken(state, token){
            state.token = token;
        },
        destroyToken(state){
            state.token = null;
        }
    },
    actions:{
        retrieveToken(context, credentials){
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
                    console.log(e);
                    reject(e);
                })
            });
        },
        destroyToken(context){
            axios.defaults.headers.common['Authorization'] = "Bearer " + context.state.token;
            if(context.getters.loggedIn){
                return new Promise((resolve, reject) => {
                    axios.post('/api/logout').then(response => {
                        localStorage.removeItem('access_token');
                        context.commit('destroyToken');
                        resolve(response);
                    }).catch(e => {
                        console.log(e);
                        localStorage.removeItem('access_token');
                        context.commit('destroyToken');
                        reject(e);
                    })
                });
            }
        }
    }
});