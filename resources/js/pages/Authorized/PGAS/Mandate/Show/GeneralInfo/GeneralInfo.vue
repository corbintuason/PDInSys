<template>
    <div>
        <hr />
        <div class="component-sub-content mt-4 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <label for="date">Date:</label>
                    <b-input
                        readonly
                        v-model="mandate.date"
                        id="date"
                        locale="en"
                    ></b-input>
                </div>
                <div class="col-md-6">
                    <label for="position">Position Applying For:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.position"
                    ></b-input>
                </div>
            </div>
            <hr />
            <div class="text-center mt-4">
                <h5>
                    <i>General Information</i>
                </h5>
            </div>
            <div class="row">
                <!-- Full Name -->
                <div class="col-md-6">
                    <div class="mandate-group">
                        <label>Full Name:</label>
                        <b-input-group>
                            <b-input
                                :disabled="mode == 'Show'"
                                v-model="mandate.full_name.last_name"
                                type="text"
                                placeholder="Last Name"
                            ></b-input>
                            <b-input
                                :disabled="mode == 'Show'"
                                v-model="mandate.full_name.first_name"
                                type="text"
                                placeholder="First Name"
                            ></b-input>
                            <b-input
                                :disabled="mode == 'Show'"
                                v-model="mandate.full_name.middle_name"
                                type="text"
                                placeholder="Middle Name"
                            ></b-input>
                        </b-input-group>
                    </div>
                </div>
                <!-- Region -->
                <div class="col-md-6">
                    <label for="region">Region:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.region"
                        id="region"
                    ></b-input>
                </div>
                <!-- Permanent Address -->
                <div class="col-md-12 mb-3 mt-3">
                    <label for="permanent-address">Permanent Address:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.permanent_address"
                        id="permament-address"
                        type="text"
                    ></b-input>
                </div>
                <!-- Present Address -->
                <div class="col-md-12 mb-3">
                    <label for="present-address">Present Address:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.present_address"
                        id="present-address"
                        type="text"
                    ></b-input>
                </div>
                <hr />
                <!-- Gender -->
                <div class="col-md-3">
                    <div class="mandate-group">
                        <label>Gender:</label>
                        <b-input
                            :disabled="mode == 'Show'"
                            v-model="mandate.gender"
                            id="gender"
                        ></b-input>
                    </div>
                </div>
                <!-- Civil Status -->
                <div class="col-md-3">
                    <label for="civil-status">Civil Status:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.civil_status"
                        id="civil-status"
                    ></b-input>
                </div>
                <!-- Birthdate -->
                <div class="col-md-3">
                    <label for="birthdate">Birthdate:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.birthdate"
                        id="birthdate"
                        locale="en"
                    ></b-input>
                </div>
                <!-- Age -->
                <div class="col-md-3">
                    <label for="age">Age:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        id="age"
                        v-model="mandate.age"
                    ></b-input>
                </div>
                <!-- Mobile Number -->
                <div class="col-md-4 mt-3">
                    <label for="mobile-number">Mobile Number:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.mobile_number"
                        id="mobile-number"
                    ></b-input>
                </div>
                <!-- Telephone Number -->
                <div class="col-md-4 mt-3">
                    <label for="telephone-number">Telephone Number:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.telephone_number"
                        id="telephone-number"
                    ></b-input>
                </div>
                <!-- Religion -->
                <div class="col-md-4 mt-3">
                    <label for="religion">Religion:</label>
                    <b-input
                        :disabled="mode == 'Show'"
                        v-model="mandate.religion"
                        id="religion"
                        type="text"
                    ></b-input>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            namespace: "mandate-" + this.$route.params.id,
        };
    },
    props: {
        mandate: Object,
        mode: String,
    },
};
</script>

<style></style>
