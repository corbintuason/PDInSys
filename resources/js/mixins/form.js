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

        loadSwalContents(item_steps, user){
            var contents = "";            
            // // Load Contents first
            item_steps.forEach((step) => {
                if (step.name == "Create") {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        user.meta.full_name +
                        "</strong></span></div>";
                } else {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        "</strong></span></div>";
                }
            });
            
            var swal_html =
                '<span>Contribution List will be Updated</span><div class="list-group">' +
                contents +
                "</div> <span>Please check the details provided</span>";
            
            return swal_html;
        },

        fireContributionList(swal_object) {
            swal.fire({
                title: swal_object.title,
                icon: "question",
                html: swal_object.html,
                confirmButtonText: swal_object.confirmButtonText,
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .post(swal_object.endpoints.api, this.project)
                            .then((response) => {
                                resolve(response.data);
                            })
                            .catch((e) => {
                                //(e);
                                swal.showValidationMessage(
                                    `Unable to create project`
                                );
                                swal.hideLoading();
                                reject(e);
                            });
                    });
                },
            }).then((result) => {
                if (result.value) {
                    swal.fire({
                        title: result.value.success_text,
                        icon: "success",
                        onClose: () => {
                            this.$router.push({
                                name: swal_object.endpoints.show_route,
                                params: { id: result.value.project.id },
                            });
                        },
                    });
                }
            });
        },

        // For validating if user can see and process a certain component
        cansee(status, role) {},
    },
};
