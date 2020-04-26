<template>
    <b-modal id="return-item" @hidden="removeSelectedUser" size="lg">
        <template v-slot:modal-title> Return {{ item_model }} </template>
        <div class="modal-body">
            <contribution-list
                :front_steps="front_steps"
                :contributors="contributors"
                @return-item="returnItem"
            ></contribution-list>
            <!-- Remarks -->
            <label class="mt-2">Remarks</label>
             <b-input-group
            v-for="(remark, remark_index) in return_to_user.remarks"
            :key="remark_index"
        >
            <b-input
                type="text"
                v-model="return_to_user.remarks[remark_index]"
            ></b-input>
            <b-input-group-append>
                <b-button
                    variant="outline-danger"
                    :disabled="remark_index == 0"
                    @click="removeRow(return_to_user.remarks, remark_index)"
                >
                    <i class="fas fa-trash"></i>
                </b-button>
            </b-input-group-append>
        </b-input-group>
            <b-button
            variant="outline-primary"
            block
            @click="addRow(return_to_user.remarks)"
            >Add Remark</b-button
        >
        </div>

        <template v-slot:modal-footer>
            <b-button
                variant="outline-success"
                :disabled="return_to_user.user == null"
                @click="returnProject"
                >Return {{ item_model }}</b-button
            >
        </template>
    </b-modal>
</template>

<script>
import contributionList from "./ContributionList";
import form from "../../../mixins/form";

export default {
    data() {
        return {
            mode: "Return",
            return_to_user: {
                user: null,
                status: "Returned",
                remarkable_type: "Project",
                remarkable_id: this.item.id,
                remarks: [""],
            },
            users: [],
        };
    },
    mixins:[form],
    props: {
        item: Object,
        item_model: String,
        front_steps: Array,
        contributors: Array,
    },
    components: {
        "contribution-list": contributionList,
    },
    methods: {
        removeSelectedUser(){
            this.return_to_user = {
                user: null,
                show_link_route: "project_show",
                remarkable_type: "Project",
                remarkable_id: this.item.id,
                remarks: [""],
            }
        },
        returnItem(item) {
            this.return_to_user.user = item;
        },
        returnProject(){
            swal.fire({
                title: "Return Project",
                icon: "question",
                confirmButtonText: "Return Project",
                text: "Project will be returned to " + this.return_to_user.user.name,
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/project/" + this.item.id, this.return_to_user)
                            .then((response) => {
                                const item = response.data;
                                resolve(item);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(`Unable to return project`);
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    //(result);
                    swal.fire({
                        title: "Project Successfully Returned",
                        icon: "success",
                        onClose: () => {
                            this.$router.go();
                        },
                    });
                }
            });
        }
    },
    mounted() {},
};
</script>
