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

        getResponsibilities(item_steps, item) {
            var users = [];
            item_steps.forEach((step) => {
                var same_responsibility = item.relationships.contributors.find(
                    (user) => user.responsibility == step.responsible
                );
                if (same_responsibility != null) {
                    users.push({
                        id: same_responsibility.contributor_id,
                        responsibility: same_responsibility.responsibility,
                        name: same_responsibility.full_name,
                    });
                } else {
                    users.push({
                        id: null,
                        responsibility: step.responsible,
                        name: null,
                    });
                }
            });
            return users;
        },

        loadSwalContentsWithContributors(item_steps, user, item) {
            var current_step = this.getCurrentStep(item, item_steps);
             
           
            var contents = "";
            var contributors = this.getResponsibilities(item_steps, item);
            console.log("the contributors", contributors);
            contributors.forEach((contributor) => {
                console.log(
                    current_step.responsible + " " + contributor.responsibility
                );
                if (current_step.responsible == contributor.responsibility) {
                    console.log("pumasok ka dapat dito chong");
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        contributor.responsibility +
                        ": " +
                        user.data.full_name +
                        "</strong></span></div>";
                } else {
                    if(contributor.id!=null){
                        contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        contributor.responsibility +
                        ": " +
                        contributor.name +
                        "</strong></span></div>";
                    }else{
                        contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        contributor.responsibility +
                        ": </strong></span></div>";
                    }
                   
                }
            });
            return contents;
        },

        loadSwalContentsWithoutContributors(item_steps, user) {
            console.log("did i pass through here");
            var contents = "";
            item_steps.forEach((step) => {
                if (step.name == "Create") {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": " +
                        user.data.full_name +
                        "</strong></span></div>";
                } else {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        step.responsible +
                        ": </strong></span></div>";
                }
            });
            return contents;
        },
        loadSwalContents(item_steps, user, item) {
            var contents = "";
            // // Load Contents first
            if (item != null) {
                contents += this.loadSwalContentsWithContributors(
                    item_steps,
                    user,
                    item
                );
            } else {
                contents += this.loadSwalContentsWithoutContributors(
                    item_steps,
                    user
                );
            }
            var swal_html =
                '<span>Contribution List will be Updated</span><div class="list-group">' +
                contents +
                "</div>";

            return swal_html;
        },

        fireCreateSwal(swal_object) {
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
                            .post(swal_object.endpoints.api, swal_object.item)
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
                            if(result.value.refresh){
                                this.$router.go();
                            }else{
                                this.$router.push({
                                    name: swal_object.endpoints.show_route,
                                    params: { id: result.value.item_id },
                                });
                            }
                       
                        },
                    });
                }
            });
        },

        fireUpdateSwal(swal_object, item){
            var api_link;
            if(this.lastCharacter(swal_object.endpoints.api, "/")){
                api_link = swal_object.endpoints.api + item.id;
            }else{
                api_link = swal_object.endpoints.api;
            }
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
                            .put(api_link, {
                                status: swal_object.new_status
                            })
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

        // For validating if user can see and process a certain component
        lastCharacter(endpoint, character){
            var last_char = endpoint[endpoint.length -1];
            if(last_char == character){
                return true;
            }else{
                return false;
            }
        },

        hasItemAbility(access, ability){
            return access.some(access_ability => access_ability.name == ability)
        }
    },
};
