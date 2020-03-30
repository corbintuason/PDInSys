<template>
    <div>
        <div class="text-center">
            <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
        </div>
        <hr />
        <div class="component-sub-content mt-4 mb-3">
            <div class="row">
                <!-- Vendor Name -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Registered Vendor Name</label>
                        <b-input-group>
                            <b-input type="text" required></b-input>
                        </b-input-group>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Line of Business -->
                    <div class="form-group">
                        <label>Line of Business</label>
                        <b-input-group>
                            <b-form-select
                                v-model="selected"
                                :options="lineOfBusiness"
                                required
                            ></b-form-select>
                        </b-input-group>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Trade Name -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Trade Name</label>
                        <b-input-group>
                            <b-input type="text" required></b-input>
                        </b-input-group>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Contact Person -->
                    <div class="form-group">
                        <label>Contact Person</label>
                        <b-input-group>
                            <b-input
                                type="text"
                                placeholder="Last Name"
                                required
                            ></b-input>
                            <b-input
                                type="text"
                                placeholder="First Name"
                                required
                            ></b-input>
                            <b-input
                                type="text"
                                placeholder="Middle Name"
                            ></b-input>
                        </b-input-group>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Registered Address -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Registered Address</label>
                        <b-input-group>
                            <b-input
                                type="text"
                                placeholder="No. Street. Bldg."
                            ></b-input>
                            <b-input type="text" placeholder="Brgy."></b-input>
                            <b-input
                                type="text"
                                placeholder="City/Municipality"
                            ></b-input>
                        </b-input-group>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Contact Number -->
                    <div class="form-group">
                        <label>Contact Number</label>
                        <b-input-group>
                            <b-input
                                type="number"
                                placeholder="09xx-xxxx-xxx"
                                required
                            ></b-input>
                        </b-input-group>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <!-- Type of Business -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Type of Business</label>
                        <b-input-group>
                            <b-form-select
                                v-model="selected"
                                :options="typeOfBusiness"
                                required
                            ></b-form-select>
                        </b-input-group>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Email Address -->
                    <div class="form-group">
                        <label>Email Address</label>
                        <b-input-group>
                            <b-input
                                type="text"
                                placeholder="email@email.com"
                                required
                            ></b-input>
                        </b-input-group>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vueStep from "vue-step";
export default {
    data() {
        return {
            nowStep: 1,
            stepList: ["", "", "", ""],
            selected: null,
            lineOfBusiness: [
                { value: null, text: "Please select an option" },
                { value: "a", text: "Services" },
                { value: "b", text: "Goods" }
            ],
            typeOfBusiness: [
                { value: null, text: "Please select an option" },
                { value: "a", text: "Sole Proprietorship" },
                { value: "b", text: "Corporation" }
            ]
        };
    },
    components: {
        vueStep
    }
};
</script>

<style lang="scss" scoped>
* {
    font-family: "Lato";
}
</style>
