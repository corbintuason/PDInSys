<template>
    <b-modal @hidden="changeShowRejectModal(false)" v-model="show_reject_modal" size="lg">
        <template v-slot:modal-title> Reject {{name}} </template>
        <div class="modal-body">

            <!-- Remarks -->
            <label class="mt-2">Remarks</label>
            <b-input-group
                v-for="(remark, remark_index) in remarks"
                :key="remark_index"
            >
                <b-input
                    type="text"
                    v-model="remarks[remark_index]"
                ></b-input>
                <b-input-group-append>
                    <b-button
                        variant="outline-danger"
                        :disabled="remark_index == 0"
                        @click="removeRow(remarks, remark_index)"
                    >
                        <i class="fas fa-trash"></i>
                    </b-button>
                </b-input-group-append>
            </b-input-group>
            <b-button
                variant="outline-primary"
                block
                @click="addRow(remarks)"
                >Add Remark</b-button
            >
        </div>

        <template v-slot:modal-footer>
            <b-button
                variant="outline-danger"
                @click="rejectProject"
                >Reject {{ name }}</b-button
            >
        </template>
    </b-modal>
</template>

<script>
import contributionList from "./ContributionList";
import form from "../../../mixins/form";
import {mapState, mapMutations} from "vuex";

export default {
    data() {
        return {
            mode: "Return",
            remarks: [""],
        };
    },
    mixins: [form],
    props: {
          namespace: String
    },
    components: {
        "contribution-list": contributionList,
    },
    computed: {
        ...mapState({
            show_reject_modal(state){
                return state[this.namespace].show_reject_modal;
            },
            item(state) {
                return state[this.namespace].item;
            },
            name(state){
                return state[this.namespace].name;
            },
            steps(state) {
                 return state[this.namespace].steps;
            },
            endpoints(state, getters){
                return getters[this.namespace + "/getEndpoints"]
            }
        }),
      
    },
    methods: {
            ...mapMutations({
        changeShowRejectModal(commit, payload){
            return commit(this.namespace + "/changeShowRejectModal", payload);
        }
        }),

        rejectProject() {
            swal.fire({
                title: "Reject " + this.name + " " + this.item.code+"?",
                icon: "question",
                confirmButtonText: "Reject",
                cancelButtonColor: "#d33",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put(
                                this.endpoints.api +
                                    "/reject", this.remarks
                            )
                            .then((response) => {
                                const item = response.data;
                                resolve(item);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to reject project`
                                );
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    //(result);
                    swal.fire({
                        title: result.value.success_text,
                        icon: "success",
                        onClose: () => {
                            this.$router.go();
                        },
                    });
                }
            });
        },
        loadReturnItem() {
        },
    },
    mounted() {
        console.log(this.namespace);
        console.log("name space is ", this.namespace);
        this.loadReturnItem();
    },
};
</script>
