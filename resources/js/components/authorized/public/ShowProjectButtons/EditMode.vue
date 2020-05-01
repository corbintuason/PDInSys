<template>
<b-button-group class="float-right">
    <b-button variant="outline-success" @click="saveChanges">Save Changes</b-button>
    <b-button variant="outline-danger" @click="discardChanges">Discard Changes</b-button>
</b-button-group>
</template>

<script>
export default{
    data(){
        return{

        }
    },
    props:{
        item: Object,
        item_model: String,
        steps: Array,
        endpoints: Object
    },
    methods:{
        saveChanges(){
            swal.fire({
                title: "Save Changes to " + this.item_model + " " + this.item.code +"?",
                icon: "question",
                confirmButtonText: "Save",
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put(this.endpoints.api + this.item.id, this.item)
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
        discardChanges(){
            Fire.$emit('switch-mode', 'Show');
        }
    }
}
</script>