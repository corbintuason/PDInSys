<template>
    <div>
        <div class="text-center">
            <vue-step :now-step="nowStep" :step-list="stepList"></vue-step>
        </div>
        <hr />
        <div class="component-sub-content mt-4 mb-4"></div>
        <div>
            <b-button class="font-weight-bold" block variant="primary"
                >Create Vendor</b-button
            >
        </div>
    </div>
</template>

<script>
import vueStep from "vue-step";
export default {
    data() {
        return {
            nowStep: 4,
            stepList: ["", "", "", ""]
        };
    },
    components: {
        vueStep
    }
};
</script>

<style></style>
