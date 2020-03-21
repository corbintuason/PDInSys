<template>
    <div>
        <h3>Edit User Information</h3>
        <div class="component-sub-content">
            <!-- Full Name -->
            <div class="form-group">
                <label>Full name</label>
                <div class="input-group">
                    <input
                        type="text"
                        v-model="user.data.first_name"
                        class="form-control"
                    />
                    <input
                        type="text"
                        v-model="user.data.middle_name"
                        class="form-control"
                    />
                    <input
                        type="text"
                        v-model="user.data.last_name"
                        class="form-control"
                    />
                </div>
            </div>
            <!-- Contact Number -->
            <div class="form-group">
                <label>Contact Number</label>
                <b-input-group>
                    <b-input
                        type="text"
                        v-model="user.data.contact_numbers"
                    ></b-input>
                </b-input-group>
            </div>
            <!--PD Email-->
            <div class="form-group">
                <label>PD Email</label>
                <b-input-group>
                    <b-input
                        type="email"
                        v-model="user.data.pdem_email"
                    ></b-input>
                </b-input-group>
            </div>
            <!-- PD Gmail -->
            <div class="form-group">
                <label>PD Gmail</label>
                <b-input-group>
                    <b-input
                        type="email"
                        v-model="user.data.pdem_gmail"
                    ></b-input>
                </b-input-group>
            </div>
            <div>
                <b-button class="font-weight-bold" block variant="primary"
                    >Update</b-button
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user"))
        };
    }
};
</script>

<style lang="scss" scoped>
* {
    font-family: "Lato";
}
</style>
