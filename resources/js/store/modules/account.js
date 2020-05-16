import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";

Vue.use(Vuex);
export default{
    namespaced: true,
    state: {
        name: "Account",
        model: "App\\Account",
        mode: "Show",
        item: null,
        
        loading: true,
        show_return_modal: false,
        steps: [
            {
                name: "Create",
                responsible: "Creator",
                database_equivalent: ["Returned to Creator"],
            },
            {
                name: "Approve",
                responsible: "Approver",
                database_equivalent: ["For Approval", "Returned to Approver"],
            },
            {
                name: "Approve",
                responsible: null,
                database_equivalent: ["Approved"],
            },
        ]
    },
    getters: {
        getItem(state){
            console.log("i wonder why", state.item);
            return state.item;
        },
        getSteps(state){
            return state.steps;
        },
        getMode(state){
            return state.mode;
        },
        getEndpoints(state){
            var endpoints = {
                api: "/api/account/"+state.item.id
            };

            return endpoints;
        },
        getClients(state){
            return state.item.clients;
        },
        getShowReturnModal(state){
            return state.show_return_modal;
        }
    },
    mutations: {
        storeItem(state, account){
            state.item = account;
        },
        changeMode(state, mode){
            console.log("pumasok ba");
            state.mode = mode;
        },
        changeShowReturnModal(state, status){
            console.log("is something happening");
            state.show_return_modal = status;
            console.log(state.show_return_modal);
        }
    },
    actions: {
        changeMode(context, mode) {
            // return new Promise((resolve, reject) => {
            //     console.log('aitttttttttttttt');
            //     console.log(id);
            //     axios.get("/api/account/"+id).then(response => {
            //         var account = response.data.data;
            //         context.commit("storeAccount", account);
            //         resolve(account);
            //     }).catch(e => {
            //         reject(e);
            //     });
            // });
            context.commit("changeMode", mode);
            if(mode == 'Show'){
                context.dispatch('storeAccount', context.state.account.id);
            }
        },
        storeItem(context, id) {
            return new Promise((resolve, reject) => {
                console.log('aitttttttttttttt');
                console.log(id);
                axios.get("/api/account/"+id).then(response => {
                    var account = response.data.data;
                    console.log("am i being changed?", id);
                    context.commit("storeItem", account);
                    resolve(account);
                }).catch(e => {
                    reject(e);
                });
            });
        },

    },
};
