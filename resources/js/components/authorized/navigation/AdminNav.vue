<template>
    <div>
        <admin-navbar></admin-navbar>
        <admin-sidebar :user="user"></admin-sidebar>
    </div>
</template>

<script>
import AdminSideBar from './AdminSidebar'
import AdminNavBar from './AdminNavbar'
export default{
      data() {
        return {
        };
    },
    props:{
        user: Object
    },
    components: {
        "admin-navbar": AdminNavBar,
        "admin-sidebar": AdminSideBar
    },
    created(){

    }
}

</script>