<template>
    <div>
        <label>Account</label>
        <!-- If Account is Null -->
        <b-form-group
            v-if="project.account == null"
            label-class="font-weight-bold"
            class="mb-0"
        >
            <b-alert show variant="danger" class="mb-0">
                <strong>No Account has been selected</strong>
            </b-alert>
        </b-form-group>

        <!-- If Account is not Null -->
        <b-card v-else class="mb-0" :title="client_name">
            <b-card-text>
                <strong>Department:</strong> {{ project.account.department }}
            </b-card-text>

            <b-card-text>
                <strong>Brand:</strong> {{ project.account.brand }}
            </b-card-text>
        </b-card>
                    <b-button v-if="mode=='Edit'" block variant="outline-primary" @click="selectAccount"
                >Select an Account</b-button
            >
        <select-account
            v-if="mode=='Edit'"
            :project="project"
            :key="select_account_key"
            @reset-select-account-client="resetSelectAccountClient"
        ></select-account>

    </div>
</template>

<script>
import selectAccount from "../components/SelectAccount";

export default {
    data() {
        return {
            select_account_key: 0,
        };
    },
    props: {
        project: Object,
        mode: String
    },
    components: {
        "select-account": selectAccount,
    },
    computed: {
        client_name() {
            return (
                this.project.account.client.salutation +
                " " +
                this.project.account.client.last_name +
                ", " +
                this.project.account.client.first_name
            );
        },
    },
    methods: {
        selectAccount() {
            this.$bvModal.show("select-account");
        },
        resetSelectAccountClient() {
            this.select_account_key++;
        },
    },
};
</script>
