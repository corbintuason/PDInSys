<template>
    <div>
        <admin-navbar></admin-navbar>
        <admin-sidebar></admin-sidebar>
    </div>
</template>

<script>
import AdminSideBar from './AdminSidebar'
import AdminNavBar from './AdminNavbar'
export default{
      data() {
        return {
            user: {}
        };
    },
    components: {
        "admin-navbar": AdminNavBar,
        "admin-sidebar": AdminSideBar
    },
}

</script>