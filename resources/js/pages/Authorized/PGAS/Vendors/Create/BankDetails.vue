<template>
    <div>
        <div class="text-center">
            <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
        </div>
        <hr />
        <div class="component-sub-content  mt-4 mb-4">
            <div class="row">
                <!-- Bank Name -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Bank Name</label>
                        <b-input-group>
                            <b-input type="text"></b-input>
                        </b-input-group>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Account Name -->
                    <div class="form-group">
                        <label>Account Name</label>
                        <b-input-group>
                            <b-input type="text"></b-input>
                        </b-input-group>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Account Number -->
                    <div class="form-group">
                        <label>Account Number</label>
                        <b-input-group>
                            <b-input type="text"></b-input>
                        </b-input-group>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <b-button class="font-weight-bold" block variant="primary"
                >Next</b-button
            >
        </div>
    </div>
</template>

<script>
import vueStep from "vue-step";
export default {
    data() {
        return {
            nowStep: 3,
            stepList: ["", "", "", ""]
        };
    },
    components: {
        vueStep
    }
};
</script>

<style></style>
