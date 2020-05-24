<template>
    <b-button-group>
        <b-button @click="editItem" variant="outline-primary"
            ><i class="fas fa-edit"></i> Edit</b-button
        >
        <b-button variant="outline-danger"
            ><i class="fas fa-trash-alt"></i> Delete</b-button
        >
    </b-button-group>
</template>

<script>
import { mapMutations } from "vuex";
export default {
    data() {
        return {};
    },
    props: {
        namespace: String,
    },
    methods: {
        ...mapMutations({
            changeMode(commit, payload) {
                return commit(this.namespace + "/changeMode", "Edit");
            },
        }),
        editItem() {
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
                            this.changeMode();
                        },
                    });
                }
            });
        },
    },
};
</script>
