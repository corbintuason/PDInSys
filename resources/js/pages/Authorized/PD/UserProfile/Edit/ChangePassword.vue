<template>
    <div>
        <h3>Edit Password</h3>
        <div class="component-sub-content">
            <!-- Contact Number -->
            <div class="form-group">
                <label>Password</label>
                <b-input-group>
                    <b-input type="password" v-model="password"></b-input>
                </b-input-group>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <b-input-group>
                    <b-input
                        type="password"
                        v-model="confirm_password"
                    ></b-input>
                </b-input-group>
            </div>
            <div>
                <b-button
                    class="font-weight-bold"
                    block
                    variant="primary"
                    @click="updatePassword"
                    >Update Password</b-button
                >
            </div>
        </div>
    </div>
</template>

<script>
import form from "../../../../../mixins/form";
export default {
    data() {
        return {
            user: this.$store.state.user,
            password: "",
            confirm_password: "",
        };
    },
    mixins: [form],
    methods: {
        updatePassword() {
            swal.fire({
                title: "Update Password",
                icon: "question",
                confirmButtonText: "Are you sure?",
                text: "Password Update",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        axios
                            .put("/api/user/"+this.user.data.id, {
                                password: this.password,
                            })
                            .then((response) => {
                                const item = response.data;
                                this.$router.go();
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
            });

        },
    },
};
</script>

<style></style>
