import axios from "axios";
import swal from "sweetalert2";
import {app} from "../../../app"

export const showRFPModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "RFP",
            model: "App\\RFP",
            mode: "Show",

            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: true,
            show_budget_request_modal: false,

            // BELOW ARE FIELDS UNIQUE TO THE MODULE
            item: null,
        };
    },
    getters: {
       steps(state, getters, rootState){
        return rootState.rfp.steps;
       },
       getParentName(state){
           return state.parent.name;
       },
       mode_of_payments(state, getters, rootState){
        return rootState.rfp.mode_of_payments;
    },
    getCurrentStep(state, getters) {
        var status = state.item.status;
        var current_step = getters.steps.find((step) => {
            return step.database_equivalent.includes(status);
        });
        return current_step;
    },
    },
    mutations: {
        
        addEntry(state, entry) {
            console.log("check if pushed");
            console.log(entry);
            state.item.entries.push(entry);
        },
        deleteEntry(state, category) {
            var entry = state.item.entries.findIndex((entry, index) => {
                return entry.category == category.category && category.entry_index == index
            });
            state.item.entries.splice(entry, 1);            
        },
        setEditEntry(state, entry_object){
            console.log("awit", entry_object);
            state.edit_entry = entry_object.entry;
            state.edit_category = entry_object.category
        },
        setMode(state, mode) {
            state.mode = mode;
        },
        setParent(state, parent){
            state.parent = parent;
            state.loading = false;
        },
        setStartDate(state, start_date){
            state.item.start_date = start_date;
        },
        setEndDate(state, end_date){
            state.item.end_date = end_date;
        },
        setRfpableType(state, type){
            state.item.brable_type = type;
        },
        setRfpableId(state, id){
            state.item.brable_id = id;
        },
        selectVendor(state, vendor){
            if(vendor!=null){
                state.item.vendor_id = vendor.id;
            }else{
                state.item.vendor_id = null;
            }
        },
        setVendor(state, vendor){
            state.selected_vendor = vendor;
            console.log(state.selected_vendor, state.item.vendor_id);

        },
        storeItem(state, rfp){
            state.item = rfp;
        },
        setLoading(state, loading){
            state.loading = loading;
        }
    },
    actions: {
        loadParentRequirement({commit, state}, parent_id){
            if(state.type == 'Project'){
                console.log("hmm");
                axios.get("/api/project/"+parent_id).then(response => {
                    var project = response.data.data;
                    commit("setParent", project);
                    commit("setRfpableType", "App\\Project");
                    commit("setRfpableId", project.id);
                });                  
            }else if (state.type =='Account'){
                // axios.get("/api/account/"+parent_id).then(response => {
                //     var project = response.data.data;
                //     commit("setParent", project);
                // });      
            }
        },

        selectVendor({commit, state}, vendor){
            commit("selectVendor", vendor);
            commit("setVendor", vendor);
            console.log(state.selected_vendor, state.item.vendor_id);

        },
        
        storeItem({ commit, state }, rfp_id) {
            axios.get("/api/erfp/" + rfp_id).then((response) => {
                var rfp = response.data.data;
                console.log("?ASD<A?SD<A?SD", rfp);
                commit("storeItem", rfp);
                commit("setLoading", false);
            });
        },
       
    },
};
