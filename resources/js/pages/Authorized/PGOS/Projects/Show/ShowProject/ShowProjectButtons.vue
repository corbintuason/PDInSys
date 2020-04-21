<template>
    <div>
        <b-button-group class="float-right">
            <!-- Reject Project -->

            <b-button class="float-right" variant="outline-danger"
                >Reject Project</b-button
            >
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
        </b-button-group>

        <return-item
            :item="project"
            :item_model="item_model"
            :front_steps="front_steps"
        ></return-item>
    </div>
</template>

<script>
import returnItem from "../../../../../../components/authorized/public/ReturnItem";

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
        project: Object,
        item_model: String,
        front_steps: Array
    },
    components:{
        "return-item": returnItem
    },
    computed:{
        showRejectProject(){
            return this.rejectProjectStatuses.includes(this.project.status);
        },
        showReturnProject(){
            return this.returnProjectStatuses.includes(this.project.status);
        },
        showReviewProject(){  
            console.log("aaa");  
            return this.reviewProjectStatuses.includes(this.project.status) && this.user.abilities.find(ability=> ability.name == 'review-all-projects') != null;
        },
        showApproveProject(){
            return this.approveProjectStatuses.includes(this.project.status);
        }
    },
    methods: {
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
                            this.$router.push({name: 'project_index'});
                        },
                    });
                }
            });
        },
        reviewProject() {
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
