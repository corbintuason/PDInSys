<template>
    <div>
        <b-card class="mt-3">
            <template v-slot:header>
                <h1 class="component-title">
                    {{ account.code }}
                </h1>
            </template>
            <b-card-body>
                <b-card-text>
                    <b-form-group :disabled="mode == 'Show'">
                        <b-tabs content-class="mt-3" fill>
                            <b-tab title="Account Information" active>
                                <account-information></account-information>
                            </b-tab>
                            <b-tab title="Clients Information">
                                <clients-information></clients-information>
                            </b-tab>
                        </b-tabs>
                    </b-form-group>
                </b-card-text>
            </b-card-body>
            <template v-slot:footer>
                <show-process-buttons
                    :mode="mode"
                    :item="account"
                    :item_model="'Account'"
                    :steps="steps"
                    :endpoints="endpoints"
                    :namespace="namespace"
                ></show-process-buttons>
                <!-- For Approval Status -->
            </template>
        </b-card>
    </div>
</template>

<script>
import form from "../../../../../mixins/form";
import accountInformation from "./AccountInformation";
import clientsInformation from "./ClientsInformation";
import { mapGetters, mapState } from "vuex";

export default {
    data() {
        return {
            namespace: "account-" + this.$route.params.id,
        };
    },
    mixins: [form],
    components: {
        "account-information": accountInformation,
        "clients-information": clientsInformation,
    },
    props: {},
    computed: {
        ...mapState({
            account(state, getters) {
                return getters[this.namespace + "/getItem"];
            },
            steps(state, getters) {
                return getters[this.namespace + "/getSteps"];
            },
            mode(state, getters) {
                return getters[this.namespace + "/getMode"];
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
