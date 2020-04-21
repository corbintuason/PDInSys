<template>
    <div class="col-md-4">
        <strong>Account List</strong>
        <b-list-group v-if="accounts != null">
            <b-list-group-item
                v-for="(account, account_index) in accounts"
                :key="account_index"
                href="#"
                @click="selectAccount(account)"
            >
                {{ account.registered_name }}
            </b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
export default {
    data() {
        return {
            accounts: null,
        };
    },
    methods: {
        loadAccounts() {
            axios.get("/api/account").then((response) => {
                this.accounts = response.data.data;
            });
        },
        selectAccount(account) {
            this.$emit('account-selected', account);
        },
    },
    mounted() {
        this.loadAccounts();
    },
};
</script>
