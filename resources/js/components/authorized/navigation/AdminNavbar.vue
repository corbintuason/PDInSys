<template>
    <nav
        class="main-header navbar navbar-expand bg-white navbar-light border-bottom"
    >
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a
                    class="nav-link"
                    data-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                >
                    <i class="far fa-bell" style="font-size:23px"></i>
                    <span
                        class="badge badge-warning navbar-badge"
                        style="font-size:9px;"
                    ></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header"
                        >Notifications</span
                    >
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer"
                        >See All Notifications</a
                    >
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {};
    },
    computed: {},
    created() {}
};
</script>

<style lang="scss" scoped></style>
