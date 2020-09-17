<template>
    <li class="nav-item menu-open">
        <div class="sidebar-header"></div>
        <a href="#" class="nav-link text-center">
            <p>
                <strong>Quick Access</strong>
            </p>
        </a>
        <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
        >
            <!-- Accounts and Clients -->
            <li class="nav-item">
                <router-link :to="{ name: 'user_create' }" class="nav-link">
                    <i class="fas fa-user" style="margin-right:10px"></i>
                    <p>Add User</p>
                </router-link>
            </li>

            <!-- Create ERFP -->
            <li class="nav-item">
                <router-link :to="{ name: 'erfp_create' }" class="nav-link">
                    <i class="fas fa-user" style="margin-right:10px"></i>
                    <p>Create ERFP</p>
                </router-link>
            </li>

        </ul>
    </li>
</template>

<script>
export default {
    data() {
        return {};
    }
};
</script>
