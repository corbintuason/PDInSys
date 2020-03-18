<template>
    <aside class="main-sidebar sidebar-light-primary elevation-1">
        <router-link :to="{ name: 'Dashboard' }">
            <div class="brand-image-holder">
                <img
                    :src="'/img/logo/project-duo.png'"
                    alt="Project Duo"
                    class="brand-image"
                />
            </div>
        </router-link>

        <div class="sidebar">
            <!-- User Panel -->
            <!-- <user-panel :user="user"> </user-panel> -->

            <!-- Sidebar Menu -->
            <nav class="mt-4 user-panel">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <!-- PGOS RELATED -->
                    <pgos-panel></pgos-panel>

                    <!-- PGAS -->
                    <pgas-panel></pgas-panel>

                    <!-- ModuleLess -->
                    <module-less></module-less>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
import pgosPanel from "./SideBar/PGOSPanel";
import pgasPanel from "./SideBar/PGASPanel";
import moduleLess from "./SideBar/ModuleLess";
export default {
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user"))
        };
    },
    components: {
        "pgos-panel": pgosPanel,
        "pgas-panel": pgasPanel,
        "module-less": moduleLess
    },
    methods: {},
    mounted() {
        console.log(this.user);
    }
};
</script>

<style lang="scss" scoped>
* {
    box-sizing: border-box;
    font-family: "Lato";
}
.brand-image-holder {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    margin-top: 10px;
}
.brand-image {
    height: 60px;
    width: 210px;
}
</style>
