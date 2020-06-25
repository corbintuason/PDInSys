<template>
    <b-button-group>
        <b-button variant="outline-primary" @click="saveChanges"
            >Save Changes</b-button
        >
        <b-button variant="outline-success" @click="updateItem"
            >Update Liq. Journal</b-button
        >
    </b-button-group>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    data() {
        return {};
    },
    computed: {
        ...mapState("liquidation-journal", {
            liqudation_journal: (state) => state.item,
        }),
    },
    methods: {
        ...mapActions("liquidation-journal", {
            updateItem: (dispatch) => {
                return dispatch("updateItem");
            }
        }),
        saveChanges() {
            swal.fire({
                title: "Save Changes to " + this.liqudation_journal.code + "?",
                text: "Are you sure you want to save this?",
                icon: "question",
                confirmButtonText: "Save",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put(
                                "/api/liquidation_journal/" +
                                    this.liqudation_journal.id +
                                    "/saveState",
                                this.liqudation_journal
                            )
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
                    title:
                        "Successfully Saved Changes to " +
                        this.liqudation_journal.code,
                    icon: "success",
                    onClose: () => {
                        this.$router.go();
                    },
                });
            });
        },
    },
};
</script>
