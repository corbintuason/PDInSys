<template>
    <div>
        <b-button-group class="float-right">
            <!-- Reject Project -->

            <b-button @click="rejectProject" v-if="showRejectProject" class="float-right" variant="outline-danger"
                >Reject Project</b-button
            >
            <b-button @click="updateStatus" variant="outline-success">{{action_button}}</b-button>
            <!-- Return Project -->
            <b-button
                @click="returnProject"
                v-if="showReturnProject"
                class="float-right"
                variant="outline-secondary"
                >Return Project</b-button
            >
            <!-- Review Project -->

            <b-button
                @click="reviewProject"
                v-if="showReviewProject"
                class="float-right"
                variant="outline-success"
                >Review Project</b-button
            >

            <!-- Approve Project -->
               <b-button
                @click="aproveProject"
                v-if="showApproveProject"
                class="float-right"
                variant="outline-success"
                >Approve Project</b-button
            >

            <b-button
            @click="editProject"
            v-if="showEditProject"
            class="float-right"
            variant="outline-dark"
            > Edit Project
            </b-button>
        </b-button-group>

        <return-item
            :item="item"
            :item_model="item_model"
            :front_steps="front_steps"
            :contributors="contributors"
        ></return-item>
    </div>
</template>

<script>
import returnItem from "../../../../../../components/authorized/public/ReturnItem";
import form from "../../../../../Authorized"
export default {
    data(){
        return{
            user: this.$store.state.user,
            reviewProjectStatuses: ["For Review"],
            approveProjectStatuses: ["For Approval"],
            returnProjectStatuses: ["For Review", "For Approval"],
            rejectProjectStatuses: ["For Review", "For Approval"],
        }
    },
    props:{
        item: Object,
        item_model: String,
        front_steps: Array,
        contributors: Array,
        mode: String
    },
    components:{
        "return-item": returnItem
    },
    computed:{
        action_button(){
            return "Action Button"
        },
        showEditProject(){
            return true;
        },
        showRejectProject(){
            // Status of Project should be included in the array
            // Logged in user 
            return this.rejectProjectStatuses.includes(this.item.status) && this.$store.getters.hasAbility("reject-all-projects");
        },
        showReturnProject(){
            return this.returnProjectStatuses.includes(this.item.status) && this.$store.getters.hasAbility("return-all-projects");
        },
        showReviewProject(){  
            return this.reviewProjectStatuses.includes(this.item.status) && this.$store.getters.hasAbility("review-all-projects");
        },
        showApproveProject(){
            return this.approveProjectStatuses.includes(this.item.status) && this.$store.getters.hasAbility("approve-all-projects");
        }
    },
    methods: {
        updateStatus(){},
        editProject(){
           
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
        aproveProject() {
            swal.fire({
                title: "Approve Project",
                icon: "question",
                confirmButtonText: "Approve Project",
                text: "Please check the details provided",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/project/" + this.project.id, {
                                status: "Approved",
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
                        title: "Project Successfully Approved",
                        icon: "success",
                        timer: "2500",
                        onClose: () => {
                            this.$router.go();
                        },
                    });
                }
            });
        },
        reviewProject() {
                   var swal_html = this.loadSwalContents(this.steps, this.user);
            console.log(this.endpoints);
            console.log("testing");
            const swal_object = {
                title: "Create Project",
                html: swal_html,
                text: "Please check the details provided.",
                confirmButtonText: "Create Project",
                endpoints: this.endpoints,
                completion_title: "Project Succesfully Created",
            };
            this.fireContributionList(swal_object);


            swal.fire({
                title: "Review Project",
                icon: "question",
                confirmButtonText: "Review Project",
                text: "Please check the details provided",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/project/" + this.project.id, {
                                status: "For Approval",
                            })
                            .then((response) => {
                                const item = response.data;
                                resolve(item);
                            })
                            .catch((e) => {
                                swal.showValidationMessage(`Unable to update`);
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    swal.fire({
                        title: "Project Successfully Reviewed",
                        icon: "success",
                        timer: "2500",
                        onClose: () => {
                                this.$router.go();
                        },
                    });
                }
            });
        },
        
        returnProject() {
            this.$bvModal.show("return-item");
        },
    },
};
</script>
