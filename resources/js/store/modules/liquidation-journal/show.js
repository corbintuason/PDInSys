import axios from "axios";
export const liquidationJournalModule = {
    namespaced: true,
    state() {
        return {
            // MUST BE PRESENT FOR EVERY MODULE
            name: "Liquidation Journal",
            model: "App\\LiquidationJournal",
            mode: "Show",

            item: null,
            loading: true,
            show_return_modal: false,
            show_reject_modal: false,
            show_remarks_modal: false,
            show_liqudation_journal_modal: false,


            tags: ["VAT", "Non-VAT", "AR"],

            liquidation_journal: {},
        };
    },
    getters: {
        steps(state, getters, rootState){
            return rootState.liquidationJournal.steps;
           },
        getTotalBudgetRequest(state, getters) {
            var total = 0;
            state.item.categories.forEach((category) => {
                category.entries.forEach((entry) => {
                    total +=
                        entry.quantity *
                        entry.unit_price *
                        entry.no_of_days *
                        entry.no_of_venues;
                });
            });
            return total;
        },
        active_categories(state) {
            return state.item.categories.filter(
                (category) => category.entries.length > 0
            );
        },
        getParentName(state) {
            return state.item.parent.name;
        },
        getCurrentStep(state, getters) {
            var status = state.item.status;
            var current_step = getters.steps.find((step) => {
                return step.database_equivalent.includes(status);
            });
            return current_step;
        },
        getEndpoints(state) {
            var endpoints = {
                api: "/api/liquidation_journal/" + state.item.id
            };

            return endpoints;
        },
    },
    mutations: {
        storeItem(state, journal) {
            state.item = journal;
            console.log("checking journal", journal);
        },
        addEntry(state, category) {
            console.log(state.item, "!!!");
            state.item.entries.push({
                date: null,
                category: null,
                gross_amount: 0,
                customer: null,
                description: null,
                tin: null,
                address_line_1: null,
                address_line_2: null,
                invoice: null,
                vat_exempt_sales: 0,
                tag: null,
            });
        },
        deleteEntry(state, entry_index) {
            state.item.entries.splice(entry_index, 1)
        },
        changeShowReturnModal(state, status) {
            console.log("is something happening");
            state.show_return_modal = status;
            console.log(state.show_return_modal);
        },

        changeShowRemarksModal(state, status) {
            console.log("remarks modal", state.show_remarks_modal);
            state.show_remarks_modal = status;
            console.log("should change", state.show_remarks_modal);
        },
    },
    actions: {
        storeItem({ commit, state }, journal) {
            commit("storeItem", journal);
            commit("setLoading", false);
        },
        updateItem({ commit, state, getters }){
                swal.fire({
                    title: getters.getCurrentStep.name + " " + state.name +"?",
                    icon: "question",
                    confirmButtonText: getters.getCurrentStep.name,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    allowOutsideClick: false,
                    input: 'checkbox',
                    inputPlaceholder: 'Please click this if you skipped this process',
                    preConfirm: (checkbox) => {
                        return new Promise((resolve, reject) => {
                            var skipped = {
                                skipped: checkbox
                            };
                            axios
                                .put(getters.getEndpoints.api, state.item)
                                .then((response) => {
                                    resolve(response.data);
                                })
                                .catch((e) => {
                                    //(e);
                                    swal.showValidationMessage(
                                        `Unable to process item`
                                    );
                                    swal.hideLoading();
                                    reject(e);
                                });
                        });
                    },
                }).then((result) => {
                    if (result.value) {
                        console.log(result);
                        swal.fire({
                            title: result.value.success_text,
                            icon: "success",
                            onClose: () => {
                                app.$router.go();
                            },
                        });
                    }
                });
        }
    },
};
