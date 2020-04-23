<template>
    <div>
        <!-- Progress Bar -->

        <!-- Add User Component -->
        <add-user></add-user>
    </div>
</template>

<script>
import addUser from "./Add User/AddUser";
export default {
    data() {
        return {};
    },
    components: {
        "add-user": addUser,
    },
    methods: {},
    computed: {},
};
</script>
