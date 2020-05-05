<template>
    <b-button-group v-if="current_step!=null" class="float-right">
        <b-button
            @click="rejectProject"
            v-if="canUpdate()"
            class="float-right"
            variant="outline-danger"
            >Reject Project</b-button
        >

        <!-- Edit Project -->
        <b-button
            @click="editProject"
            v-if="showEditProject"
            class="float-right"
            variant="outline-dark"
        >
            Edit Project
        </b-button>
       <b-button 
        @click="returnItem"
        variant="outline-dark"
        > Return {{item_model}}
        </b-button>
        <b-button
            v-if="canUpdate()"
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
        showEditProject() {
            return true;
        },
        showRejectProject() {
            return this.$store.getters.hasAbility("reject-all-projects");
        },
        showReturnProject() {
            return this.$store.getters.hasAbility("return-all-projects");
        },
    },
    methods: {
        canUpdate() {
            console.log("next ability po");
            console.log(this.current_step);
            return this.$store.getters.hasAbility(
                this.current_step.ability_visibility
            );
        },
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
                new_status: this.current_step.action,
            };
            this.fireUpdateSwal(swal_object, this.item);
        },
        editProject() {
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
        rejectProject() {
            swal.fire({
                title: "Reject Project",
                icon: "question",
                confirmButtonText: "Reject Project",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/project/" + this.project.id, {
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
