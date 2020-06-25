<template>
    <b-modal
        @hidden="changeShowBudgetRequestModal(false)"
        v-model="show_budget_request_modal"
        size="xl"
    >
        <template v-slot:modal-title> View Budget Request </template>
        <div class="modal-body">
            <show-budget-request
                :budget_request="budget_request"
            ></show-budget-request>
            <total-budget-request
                namespace="create-budget-request"
            ></total-budget-request>
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <b-form-group label-class="font-weight-bold" label="Please select a reviewer">
                        <b-form-select
                            v-model="budget_request.reviewer"
                            class="mb-3"
                        >
                            <b-form-select-option :value="null" disabled
                                >Please select a Reviewer</b-form-select-option
                            >
                            <b-form-select-option
                                v-for="(reviewer,
                                reviewer_index) in budget_request_reviewers"
                                :key="reviewer_index"
                                :value="reviewer.id"
                            >
                                {{ reviewer.full_name }}</b-form-select-option
                            >
                        </b-form-select>
                    </b-form-group>
                </div>
                {{ budget_request }}
            </div>
        </div>

        <template v-slot:modal-footer>
            <b-button
                variant="outline-success"
                @click="createBudgetRequest"
                class="float-right"
                >Create Budget Request</b-button
            >
        </template>
    </b-modal>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
import showBudgetRequest from "../../components/ShowBudgetRequest";
import totalBudgetRequest from "../../components/TotalBudgetRequested";
import form from "../../../../../../mixins/form";
export default {
    data() {
        return {
            budget_request_reviewers: [],
        };
    },
    mixins: [form],
    props: {
        namespace: String,
    },
    components: {
        "show-budget-request": showBudgetRequest,
        "total-budget-request": totalBudgetRequest,
    },
    computed: {
        ...mapState("create-budget-request", {
            budget_request: (state) => state.item,
            show_budget_request_modal(state) {
                return state.show_budget_request_modal;
            },
        }),
    },
    methods: {
        ...mapMutations({
            changeShowBudgetRequestModal(commit, status) {
                return commit(
                    this.namespace + "/changeShowBudgetRequestModal",
                    status
                );
            },
            ...mapActions({
                createBudgetRequest(dispatch) {
                    return dispatch(this.namespace + "/createBudgetRequest");
                },
            }),
        }),
        loadBudgetRequestReviewers() {
            console.log("axios???");
            axios
                .get("/api/user", {
                    params: {
                        roles: ["budget-request-reivewer"],
                    },
                })
                .then((response) => {
                    this.budget_request_reviewers = response.data.data;
                });
        },
    },
    mounted() {
        this.loadBudgetRequestReviewers();
    },
};
</script>
