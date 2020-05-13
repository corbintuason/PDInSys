<template>
    <div class="row">
        <div class="col-md-12">
            <b-button-group class="float-right">
                <b-button variant="outline-success" @click="signCostEstimateDetail"
                    >Sign Cost Estimate Detail</b-button
                >
            </b-button-group>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{

        }
    },
    props:{
        detail: Object
    },
    methods:{
          async signCostEstimateDetail(swal_object) {
                                  console.log("hi po ", this.detail.endpoints.api);

            const { value: file } = await swal.fire({
                title: "Sign Cost Estimate",
                icon: "question",
                text: "Please upload the Signed Cost Estimate",
                confirmButtonText: "Upload",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                input: "file",
                inputAttributes: {
                    accept: "image/*, application/pdf",
                },
                preConfirm:(file) => {
                              return new Promise((resolve, reject) => {
                                const formData = new FormData();
                                formData.append("file", file);
                            axios
                            .post(this.detail.endpoints.api+"/sign", formData)
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
            });

        },
    }
}
</script>