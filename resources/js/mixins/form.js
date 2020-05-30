import { FormSelectPlugin } from "bootstrap-vue";
import steps from "./steps";
export default {
    data() {
        return {};
    },
    mixins:[steps],
    methods: {
        // For Adding Dynamic Rows
        addRow(model) {
            model.push("");
        },

        // For Removing Dynamic Rows
        removeRow(model, index) {
            model.splice(index, 1);
        },

        getResponsibilities(item_steps, item) {
            var users = [];
            console.log("did a bug occur first");

            item_steps.forEach((step) => {
                if(step.responsible!=null){
                    var same_responsibility = item.contributors.find(
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
                }

            });
            console.log("did a bug occur");

            return users;
        },

        loadSwalContents(item_steps, user, item) {
            var contents = "";
            var current_step = this.getCurrentStep(item, item_steps);
            var contributors = this.getResponsibilities(item_steps, item);
            // // Load Contents first
            contributors.forEach((contributor) => {
                if (current_step.responsible == contributor.responsibility) {
                    contents +=
                        '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                        contributor.responsibility +
                        ": " +
                        user.data.full_name +
                        "</strong></span></div>";
                } else {
                    if (contributor.id != null) {
                        contents +=
                            '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                            contributor.responsibility +
                            ": " +
                            contributor.name +
                            "</strong></span></div>";
                    } else {
                        contents +=
                            '<div class="list-group-item d-flex align-items-center"><span class="b-avatar mr-3 badge-secondary rounded-circle" style="width: 2.5em; height: 2.5em;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-person-fill b-icon bi"><g><path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></g></svg></span> <span class="mr-auto"><strong>' +
                            contributor.responsibility +
                            ": </strong></span></div>";
                    }
                }
            });
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
                text: "Please check the details provided",
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
        
        async fireSaveChangesWithFileSwal(swal_object){
            const { value: file } = await swal.fire({
                title: swal_object.title +"?",
                icon: "question",
                text: swal_object.text,
                confirmButtonText: swal_object.confirmButtonText,
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
                                    item: swal_object.item
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
                                .post(swal_object.endpoints.api+"/saveChanges", formData)
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
            }).catch(e => {
                console.log("error tym", e);
            })
        },

        fireSaveChangesSwal(swal_object){
             swal.fire({
                title: swal_object.title,
                icon: "question",
                text: swal_object.text,
                confirmButtonText: swal_object.confirmButtonText,
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: "#d33",
                allowOutsideClick: false,
                preConfirm:() => {
                              return new Promise((resolve, reject) => {
                                axios
                                .put(swal_object.endpoints.api+"/saveChanges", swal_object.item)
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
            }).catch(e => {
                console.log("error tym", e);
            })
        },

        async fireUploadSwal(swal_object) {
            const { value: file } = await swal.fire({
                title: swal_object.title,
                html: swal_object.html,
                text: swal_object.text,
                confirmButtonText: swal_object.confirmButtonText,
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
                                var details = swal_object.item;
                                const object = {
                                    file: file,
                                    details: swal_object.item
                                };
                                console.log("object", object);
                                const formData = new FormData();
                    
                                Object.keys(object).forEach((key) => {
                                    if(key == 'details'){
                                        console.log("pumasok siya sa details");
                                        formData.append(key, JSON.stringify(object[key]));
                                    }else{
                                        formData.append(key, object[key])
                                    }
                                });
                                console.log("file?from preconfirm hek", formData);
                            axios
                            .post(swal_object.endpoints.api, formData)
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
            if (this.lastCharacter(swal_object.endpoints.api, "/")) {
                api_link = swal_object.endpoints.api + item.id;
            } else {
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
                input: 'checkbox',
                inputPlaceholder: 'Skipped',
                preConfirm: (checkbox) => {
                    return new Promise((resolve, reject) => {
                        var skipped = {
                            skipped: checkbox
                        };
                        console.log("link?", api_link);
                        console.log("skipped?", skipped);
                        axios
                            .put(api_link, skipped)
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
        lastCharacter(endpoint, character) {
            var last_char = endpoint[endpoint.length - 1];
            if (last_char == character) {
                return true;
            } else {
                return false;
            }
        },

        hasItemAbility(access, ability) {
            return access.some(
                (access_ability) => access_ability.name == ability
            );
        },
    },
};
