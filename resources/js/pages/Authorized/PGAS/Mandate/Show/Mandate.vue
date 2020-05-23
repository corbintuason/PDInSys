<template>
    <div>
        <b-card class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">
                    {{ mandate.code }}
                </h1>
            </template>
            <b-card-body>
                <b-card-text>
                    <b-form-group :disabled="mode == 'Show'">
                        <b-tabs content-class="mt-3" fill>
                            <!-- Mandates Tab -->
                            <b-tab title="General Info" active>
                                <general-info
                                    :mode="mode"
                                    :mandate="mandate"
                                ></general-info>
                            </b-tab>
                            <b-tab title="Government Details">
                                <government-details
                                    :mode="mode"
                                    :mandate="mandate"
                                ></government-details>
                            </b-tab>
                            <b-tab title="Education and Work">
                                <education-work
                                    :mode="mode"
                                    :mandate="mandate"
                                ></education-work>
                            </b-tab>
                            <b-tab title="Other Information">
                                <other-information
                                    :mode="mode"
                                    :mandate="mandate"
                                ></other-information>
                            </b-tab>
                        </b-tabs>
                    </b-form-group>
                </b-card-text>
            </b-card-body>
            <template v-slot:footer>
                <show-process-buttons
                    :namespace="namespace"
                ></show-process-buttons>
                <!-- For Approval Status -->
            </template>
        </b-card>
    </div>
</template>

<script>
import form from "../../../../../mixins/form";
import educationWork from "./EducationWork";
import generalInfo from "./GeneralInfo";
import governmentDetails from "./GovernmentDetails";
import otherInformation from "./OtherInformation";
import showProcessButtons from "../../../../../components/authorized/public/ShowProcessButtons";
import { mapGetters, mapState } from "vuex";
export default {
    data() {
        return {};
    },
    mixins: [form],
    props: {
        namespace: String,
    },
    components: {
        "show-process-buttons": showProcessButtons,
        "education-work": educationWork,
        "general-info": generalInfo,
        "government-details": governmentDetails,
        "other-information": otherInformation,
        "show-process-buttons": showProcessButtons,
    },
    computed: {
        ...mapState({
            mandate(state) {
                return state[this.namespace].item;
            },
            steps(state, getters) {
                return state[this.namespace].steps;
            },
            mode(state, getters) {
                return state[this.namespace].mode;
            },
            endpoints(state, getters) {
                return getters[this.namespace + "/getEndpoints"];
            },
        }),
    },
    methods: {},
    mounted() {},
};
</script>

<style></style>
