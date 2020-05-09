<template>
    <b-card class="mt-3">
        <template v-slot:header>
            <h1 class="component-title" ref="lmfao">
                {{ cost_estimate_name }}
            </h1>
        </template>
        <b-card-body>
            <b-form-file
                @change="onFileChange"
                v-model="cost_estimate.file"
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop file here..."
                accept=".xlsx"
            ></b-form-file>
            {{ cost_estimate }}
        </b-card-body>
        <template v-slot:footer>
            <b-button
                @click="uploadCostEstimate"
                :disabled="disableCostEstimate"
                class="float-right"
                variant="outline-success"
                >Upload Cost Estimate</b-button
            >
        </template>
    </b-card>
</template>

<script>
import form from "../../../../../../mixins/form"
import steps from "../../../../../../mixins/steps"

export default {
    data() {
        return {            
            cost_estimate: {
                name: null,
                file: null,
            },};
    },
    computed: {
        disableCostEstimate() {
            return (
                this.cost_estimate.name == null ||
                this.cost_estimate.file == null
            );
        },
    },
    props:{
        project: Object,
        cost_estimate_name: String,
        endpoints: Object
    },
    mixins:[form, steps],
      methods: {
        onFileChange() {
            this.cost_estimate.name = this.cost_estimate_name;
        },
        uploadCostEstimate() {
            var swal_html = null;
            console.log("pa tingen endpoints", this.endpoints);
            var object = this.cost_estimate;
            console.log("object", object);
            const formData = new FormData();

            Object.keys(object).forEach((key) => {
                formData.append(key, object[key]);
            });
            const swal_object = {
                title: "Upload Cost Estimate",
                html: swal_html,
                text: "Please check the details provided.",
                confirmButtonText: "Upload Cost Estimate",

                item: formData,
                endpoints: this.endpoints,
            };
            this.fireCreateSwal(swal_object);
        },
    },
};
</script>
