<template>
    <li class="nav-item menu-open">
        <a href="#" class="nav-link text-center">
            <strong>PGAS</strong>
        </a>
        <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
        >
            <!-- Admin -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-user" style="margin-right:10px"></i>
                    <p>
                        Admin
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Companies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>ADM Advisories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Assets</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Vehicles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Warehouses</p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Accounting -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-user" style="margin-right:10px"></i>
                    <p>
                        Accounting
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Accounts and Clients</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Vendors</p>
                        </a>
                        <ul
                            class="nav nav-treeview sidebar-links"
                            style="display: none;"
                        >
                            <li class="nav-item">
                                <router-link
                                    :to="{ name: 'vendor_index' }"
                                    class="nav-link"
                                >
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>View Vendors</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    :to="{ name: 'vendor_create' }"
                                    class="nav-link"
                                >
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Vendor Accreditation</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>AFG Advisories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Billing and Collection Monitor</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Budget Allocation</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Projected Financial Statement</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Sales, Purchase, and Allowance Register</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Sales Report</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Payments</p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Human Resource -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-user" style="margin-right:10px"></i>
                    <p>
                        Human Resource
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>HR Advisories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Mandate</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>PDIS</p>
                        </a>
                    </li>
                    <!-- Add or Modify User collapse -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Sprout HR</p>
                        </a>
                    </li>
                </ul>
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
