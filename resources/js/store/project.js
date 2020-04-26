import Vue from "vue";
import Vuex from "vuex";

import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({
    namespaced: true,
    state:{
        mode: "Create",
        api_link: "/api/project",
     
        project: "",
        change_logs: null,
        core_team: null,
        project_code: null,
        contributors: null,
        remarks: null
    },
    getters:{
        // isMode(state){
        //     return state.mode;
        // }
    }, 
    mutations:{
        changeMode(state, name){
            console.log("kita ba ako");
            state.mode = name;
        },
        setProject(state, project){
            state.project = project;
        }
    },
    actions:{
        changeMode(commit, mode){
            console.log("kita ba ako");
            commit('changeMode', mode);
        },
        setProject(commit, project){
            commit('setProject', project);
        },
        test(commit){
            
        }
    }
});
