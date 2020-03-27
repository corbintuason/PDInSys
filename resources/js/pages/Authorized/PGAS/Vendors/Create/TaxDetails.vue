<template>
    <div>
        <div class="text-center">
            <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
        </div>
        <hr />
        <div class="component-sub-content mt-4 mb-4">
            <div class="row">
                <!-- TIN Number -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>TIN Number</label>
                        <b-input-group>
                            <b-input
                                type="number"
                                placeholder="000-000-000-00000"
                            ></b-input>
                        </b-input-group>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- EWT Details -->
                    <div class="form-group">
                        <label>EWT Details</label>
                        <b-input-group>
                            <b-form-select></b-form-select>
                            <b-input type="text"></b-input>
                            <b-input type="text"></b-input>
                        </b-input-group>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- VAT / NV / NR -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>VAT / NV / NR</label>
                        <b-input-group>
                            <b-form-select
                                v-model="selected"
                                :options="typeOfVat"
                            ></b-form-select>
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
            nowStep: 2,
            stepList: ["", "", "", ""],
            selected: null,
            typeOfVat: [
                { value: null, text: "Please select an option" },
                { value: "a", text: "VAT" },
                { value: "b", text: "Non-VAT" },
                { value: "c", text: "Not Registered" }
            ]
        };
    },
    components: {
        vueStep
    }
};
</script>

<style></style>
