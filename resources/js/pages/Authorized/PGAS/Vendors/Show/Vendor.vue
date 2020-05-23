<template>
    <div>
        <b-card class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">
                    {{ vendor.code }}
                </h1>
            </template>
            <b-card-body>
                <b-card-text>
                    <b-form-group :disabled="mode == 'Show'">
                        <b-tabs content-class="mt-3" fill>
                            <b-tab title="Vendor Details" active>
                                <vendor-details
                                    :mode="mode"
                                    :vendor="vendor"
                                ></vendor-details>
                            </b-tab>
                            <b-tab title="Tax Details">
                                <tax-details
                                    :mode="mode"
                                    :vendor="vendor"
                                ></tax-details>
                            </b-tab>
                            <b-tab title="Bank Details">
                                <bank-details
                                    :mode="mode"
                                    :vendor="vendor"
                                ></bank-details>
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
import vendorDetails from "./VendorDetails";
import bankDetails from "./BankDetails";
import taxDetails from "./TaxDetails";
import accreditationDetails from "./AccreditationDetails";
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
        "vendor-details": vendorDetails,
        "bank-details": bankDetails,
        "tax-details": taxDetails,
        "accreditation-details": accreditationDetails,
    },
    computed: {
        ...mapState({
            vendor(state) {
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
