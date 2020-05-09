<template>
    <b-button-group v-if="current_step!=null" class="float-right">
        <b-button
            @click="rejectButton"
            v-if="showRejectButton"
            class="float-right"
            variant="outline-danger"
            >Reject {{item_model}}</b-button
        >

        <!-- Edit Project -->
        <b-button
            @click="editButton"
            v-if="showEditButton"
            class="float-right"
            variant="outline-dark"
        >
            Edit {{item_model}}
        </b-button>
       <b-button 
        @click="returnItem"
        v-if="showReturnButton"
        variant="outline-dark"
        > Return {{item_model}}
        </b-button>
        <b-button
            v-if="showUpdateButton"
            @click="updateStatus"
            variant="outline-success"
            >{{ action_name }}</b-button
        >

 
        <return-item
            :item="item"
            :item_model="item_model"
            :steps="steps"
            :endpoints="endpoints"
        ></return-item>
    </b-button-group>
</template>

<script>
import form from "../../../../mixins/form";
import steps from "../../../../mixins/steps";
import returnItem from "../ReturnItem"
export default {
    data() {
        return {
            user: this.$store.state.user,
            current_step: null,
        };
    },
    props: {
        item: Object,
        item_model: String,
        steps: Array,
        mode: String,
        endpoints: Object,
    },
    mixins: [form, steps],
    components:{
        "return-item": returnItem
    },
    computed: {
        action_name() {
            return this.current_step
                ? this.current_step.name + " " + this.item_model
                : "awit";
        },

        showUpdateButton(){
           return this.$store.getters.hasRole(this.item.current_handler);
        },
        showEditButton() {
            // Check first if user can edit in the first place, check if now is the time to edit
           return this.$store.getters.hasRole(this.item.current_handler);
        },
        showRejectButton() {
            // Check first if user can edit in the first place, check if now is the time to reject
           return this.$store.getters.hasRole(this.item.current_handler);
        },
        showReturnButton() {
           return this.$store.getters.hasRole(this.item.current_handler);
        },
    },
    methods: {
        updateStatus() {
            var swal_html = this.loadSwalContents(
                this.steps,
                this.user,
                this.item
            );
            const swal_object = {
                title: this.action_name + " " + this.item.code,
                html: swal_html,
                confirmButtonText: this.action_name,
                endpoints: this.endpoints,
            };
            this.fireUpdateSwal(swal_object, this.item);
        },
        editButton() {
                 swal.fire({
                title: "Would you like to switch to Edit Mode?",
                icon: "question",
                confirmButtonText: "Edit",
            }).then((result) => {
                if (result.value) {
                    //(result);
                    swal.fire({
                        title: "Successfully switched to Edit Mode",
                        icon: "success",
                        onClose: () => {
                            Fire.$emit("switch-mode", 'Edit');
                        },
                    });
                }
            });
        },
        rejectButton() {
            swal.fire({
                title: "Reject " + this.item_model,
                icon: "question",
                confirmButtonText: "Reject " + this.item_model,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/project/" + this.item.id, {
                                status: "Rejected",
                            })
                            .then((response) => {
                                const item = response.data;
                                resolve(item);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(`Unable to update`);
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    //(result);
                    swal.fire({
                        title: "Project Successfully Rejected",
                        icon: "success",
                        timer: "2500",
                        onClose: () => {
                            this.$router.go();
                        },
                    });
                }
            });
        },

        returnItem() {
            this.$bvModal.show("return-item");
        },
    },
    mounted() {
        this.current_step = this.getCurrentStep(this.item, this.steps);
        console.log("current step is ", this.current_step);
    },
};
</script>
