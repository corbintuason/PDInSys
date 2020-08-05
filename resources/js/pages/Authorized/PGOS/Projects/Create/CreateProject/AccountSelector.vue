<template>
    <div>
        <label>Account</label>
        <!-- If Account is Null -->
        {{project.client_id}}
        <b-form-group
            v-if="!clientSelected"
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
                <strong>Department:</strong> {{ selected_department.name }}
            </b-card-text>

            <b-card-text>
                <strong>Brand:</strong> {{ selected_brand.name }}
            </b-card-text>
        </b-card>
                    <b-button block variant="outline-primary" @click="selectAccount"
                >Select an Account</b-button
            >
        <select-account
        ></select-account>

    </div>
</template>

<script>
import selectAccount from "../components/SelectAccount";
import {mapState} from "vuex";
export default {
    data() {
        return {
            select_account_key: 0,
        };
    },
    components: {
        "select-account": selectAccount,
    },
    computed: {
        ...mapState("create-project", {
           project: state => state.item,
           selected_client: state => state.selected_client,
           selected_department: state => state.selected_department,
           selected_brand: state => state.selected_brand
        }),
        client_name(){
            return this.selected_client.last_name + ", " + this.selected_client.first_name
        },
        clientSelected(){
            return this.project.client_id && this.project.department_id && this.project.brand_id
        }
    },
    methods: {
        selectAccount() {
            this.$bvModal.show("select-account");
        },
    },
};
</script>
