<template>
    <div>
        <b-card class="mt-3">
            <template v-slot:header>
                <item-header :namespace="namespace"></item-header>
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
import itemHeader from "../../../../../components/authorized/public/ItemHeader"
import { mapGetters, mapState } from "vuex";

export default {
    data() {
        return {};
    },
    mixins: [form],
    components: {
        "account-information": accountInformation,
        "clients-information": clientsInformation,
        "item-header": itemHeader
    },
    props: {
        namespace: String,
    },
    computed: {
        ...mapState({
            account(state) {
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
