<template>
    <div class="row">
        {{mode}}
        <div v-if="mode=='Show'" class="col-md-12">
            <b-button-group class="float-right">
                <b-button
                    @click="editButton"
                    class="float-right"
                    variant="outline-dark"
                    >Edit CE
                </b-button>
                <b-button
                    variant="outline-success"
                    @click="signCostEstimateDetail"
                    >Signed CE?</b-button
                >
            </b-button-group>
        </div>
        <div v-else-if="mode=='Edit'" class="col-md-12">
            <b-button-group class="float-right">
                <b-button
                @click="saveChanges"
                    class="float-right"
                    variant="outline-dark"
                    >Save Changes
                </b-button>
            </b-button-group>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: {
        detail: Object,
        mode: String
    },
    methods: {
         
        async saveChanges(){
            const { value: file } = await swal.fire({
                title: "Save Changes",
                icon: "question",
                text: "please make sure",
                confirmButtonText: "Save",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                input: "file",
                inputAttributes: {
                    accept: ".xlsx",
                },
                preConfirm:(file) => {
                              return new Promise((resolve, reject) => {
                                const object = {
                                    file: file,
                                    item: this.detail
                                };
                                console.log("object", object);
                                const formData = new FormData();
                    
                                Object.keys(object).forEach((key) => {
                                    if(key == 'item'){
                                        formData.append(key, JSON.stringify(object[key]));
                                    }else{
                                        formData.append(key, object[key])

                                    }
                                    
                                    
                                });
                                console.log("file?from preconfirm hek", formData);
                                axios
                                .post("/api/cost_estimate_detail/"+this.detail.id+"/saveChanges", formData)
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
                if (result.value) {
                    console.log(result);
                    swal.fire({
                        title: result.value.success_text,
                        icon: "success",
                        onClose: () => {
                        this.$router.go();
                       
                        },
                    });
                }
            }).catch(e => {
                console.log("error tym", e);
            })
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
                            Fire.$emit("switch-mode-" + this.detail.id, "Edit");
                        },
                    });
                }
            });
        },
        async signCostEstimateDetail(swal_object) {
            console.log("hi po ", this.detail.endpoints.api);

            const { value: file } = await swal
                .fire({
                    title: "Please Upload the Signed CE",
                    icon: "question",
                    confirmButtonText: "Upload",
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    allowOutsideClick: false,
                    input: "file",
                    inputAttributes: {
                        accept: "image/*, application/pdf",
                    },
                    preConfirm: (file) => {
                        return new Promise((resolve, reject) => {
                            const formData = new FormData();
                            formData.append("file", file);
                            axios
                                .post(
                                    this.detail.endpoints.api + "/sign",
                                    formData
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
                })
                .then((result) => {
                    if (result.value) {
                        console.log(result);
                        swal.fire({
                            title: "",
                            icon: "success",
                            onClose: () => {
                                this.$router.go();
                            },
                        });
                    }
                });
        },
    },
};
</script>
