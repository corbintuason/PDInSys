<template>
    <b-modal v-model="show_release_modal" id="approve-budget-request">
        <template v-slot:modal-header>
            Pre Budget Request Releasing
        </template>
        <div class="modal-body">
            <b-form-group label="BDO Reference Number">
                <b-form-input
                    v-model="approve_budget_request.reference_number"
                ></b-form-input>
            </b-form-group>
            <b-form-group v-if="accounts_payable_officers!=null" label="AFG Counterpart">
                <b-form-select v-model="approve_budget_request.afg_counterpart_id">
                    <b-form-select-option v-for="(officer, officer_index) in accounts_payable_officers" :key="officer_index" :value="officer.id">
                        {{ officer.full_name }}
                    </b-form-select-option>
                </b-form-select>
            </b-form-group>
        </div>
        <template v-slot:modal-footer>
            <b-button variant="outline-success" @click="approveBR">Release Budget Request</b-button>
        </template>
    </b-modal>
</template>

<script>
import {mapState} from "vuex";
export default {
    data() {
        return {
            accounts_payable_officers: null,
            approve_budget_request: {
                reference_number: null,
                afg_counterpart_id: null,
            },
        };
    },
    computed:{
        ...mapState("show-budget-request", {
            budget_request: state => state.item,
            show_release_modal: state => state.show_release_modal
        })
    },
    methods: {
        approveBR(){
                swal.fire({
                title: "Release Budget Request?",
                icon: "question",
                confirmButtonText: "Release",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/budget_request/"+this.budget_request.id, this.approve_budget_request)
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
                    swal.fire({
                        title: "Budget Request Released",
                        icon: "success",
                        onClose: () => {
                            this.$router.go();
                        },
                    });
            
            });

        },
        loadAFGs() {
            axios.get("/api/user", {
                params: {
                    positions: ["Accounts Payable Officer"],
                },
            }).then(response => {
                this.accounts_payable_officers = response.data.data
            });
        },
    },
    mounted() {
        this.loadAFGs();
    },
};
</script>
