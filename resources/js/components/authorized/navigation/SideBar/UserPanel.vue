<template>
    <div class="mt-2 user-panel">
        <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
        >
            <li class="nav-item has-treeview">
                <div class="nav-link">
                    <p>{{ user.meta.full_name }}</p>
                    <span><i class="right fas fa-angle-left"></i></span>
                </div>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link to="/profile" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>My Profile</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" @click="logOut">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: {
        user: Object
    },
    methods: {
        logOut() {
            this.$Progress.start();
            this.$store.dispatch("destroyToken").then(response => {
                this.$Progress.finish();
                this.$router.push({ name: "Welcome" });
            });
        }
    }
};
</script>
