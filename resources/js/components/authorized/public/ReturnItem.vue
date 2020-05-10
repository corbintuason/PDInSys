<template>
    <b-modal id="return-item" @hidden="loadReturnItem" v-model="show" size="lg">
        <template v-slot:modal-title> Return {{ item_model }} </template>
        <div class="modal-body" v-if="return_to_user!=null">
            <contribution-list
                :steps="steps"
                :contributors="item.relationships.contributors"
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
            return_to_user: null,
            users: [],
        };
    },
    mixins: [form],
    props: {
        item: Object,
        item_model: String,
        steps: Array,
        endpoints: Object,
        show: Boolean
    },
    components: {
        "contribution-list": contributionList,
    },
    computed: {
    },
    methods: {
        returnItem(item) {
            this.return_to_user.user = item;
        },
        returnProject() {
            swal.fire({
                title: "Return " + this.item_model,
                icon: "question",
                confirmButtonText: "Return",
                text:
                    this.item_model +
                    "will be returned to " +
                    this.return_to_user.user.name,
                       showCancelButton: true,
                cancelButtonColor: "#d33",
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put(
                                this.endpoints.api +
                                    this.item.id +
                                    "/returnToUser",
                                this.return_to_user
                            )
                            .then((response) => {
                                const item = response.data;
                                resolve(item);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to return project`
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
            this.return_to_user = {
                user: null,
                remarkable_type: this.item_model,
                remarkable_id: this.item.id,
                remarks: [""],
            };
        },
    },
    mounted() {
        this.loadReturnItem();
    },
};
</script>
