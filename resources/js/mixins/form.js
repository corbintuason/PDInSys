import { FormSelectPlugin } from "bootstrap-vue";

export default {
    data() {
        return {};
    },
    methods: {
        // For Adding Dynamic Rows
        addRow(model) {
            model.push("");
        },

        // For Removing Dynamic Rows
        removeRow(model, index) {
            model.splice(index, 1);
        },

        // For POSTING an item
        createItem(item) {},

        // For Updating an item

        updateItem(item, status) {},

        updateItem(swal_object, axios_form) {
            swal.fire({
                title: swal_object.title,
                icon: swal_object.icon,
                confirmButtonText: swal_object.confirmButtonText,
                text: swal_object.text,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    this.$Progress.start();
                    return new Promise((resolve, reject) => {
                        axios
                            .put(axios_form.api_link, {
                                status: axios_form.status,
                            })
                            .then((response) => {
                                const item = response.data;
                                this.$router.go();
                                resolve(item);
                            })
                            .catch((e) => {
                                this.$Progress.fail();
                                //(e);
                                swal.showValidationMessage(`Unable to create`);
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            });
        },

        // For validating if user can see and process a certain component
        cansee(status, role) {},
    },
};
