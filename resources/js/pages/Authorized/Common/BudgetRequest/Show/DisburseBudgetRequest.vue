<template>
    <b-modal v-model="show_disbursement_modal" id="disburse-budget-request">
        <template v-slot:modal-header>
            Pre Budget Request Disbursement
        </template>
        <div class="modal-body">
            <b-form-group label="Rate">
                <b-form-select v-model="disburse_budget_request.rate">
                     <b-form-select-option :value="null" disabled>
                        -- Please select a rate --
                    </b-form-select-option>
                    <b-form-select-option v-for="(option, option_index) in options" :key="option_index" :value="option">
                        {{ option }}
                    </b-form-select-option>
                </b-form-select>
            </b-form-group>
        </div>
        <template v-slot:modal-footer>
            <b-button variant="outline-success" @click="disburseBR">Disburse Budget Request</b-button>
        </template>
    </b-modal>
</template>

<script>
import {mapState} from "vuex";
export default {
    data() {
        return {
            options:["GMA", "Provincial"],
            disburse_budget_request: {
              rate: null
            },
        };
    },
    computed:{
        ...mapState("show-budget-request", {
            budget_request: state => state.item,
            show_disbursement_modal: state => state.show_disbursement_modal
        })
    },
    methods: {
        disburseBR(){
                swal.fire({
                title: "Disburse Budget Request?",
                icon: "question",
                confirmButtonText: "Disburse",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/budget_request/"+this.budget_request.id, this.disburse_budget_request)
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
                        title: "Budget Request Disbursed",
                        icon: "success",
                        onClose: () => {
                            this.$router.go();
                        },
                    });
            
            });
        },
    },
    mounted() {

    },
};
</script>
