import Welcome from "./pages/Welcome";
import Authorized from "./pages/Authorized.vue";
import Dashboard from "./pages/Authorized/Dashboard.vue";
import AddUser from "./pages/Authorized/ADMIN/AddUser.vue";

// Single Pages
import Notifications from "./pages/Authorized/Notifications.vue";
// PGOS

// Account and Client Accreditation
import CreateAccount from "./pages/Authorized/PGOS/Accounts/Create.vue";
import IndexAccount from "./pages/Authorized/PGOS/Accounts/Index.vue";
import ShowAccount from "./pages/Authorized/PGOS/Accounts/Show.vue";

// Project Creation Module
import IndexProject from "./pages/Authorized/PGOS/Projects/Index.vue";
import CreateProject from "./pages/Authorized/PGOS/Projects/Create.vue";
import ShowProject from "./pages/Authorized/PGOS/Projects/Show.vue";
import CostEstimate from "./pages/Authorized/PGOS/CostEstimate/Create.vue"
// PGAS

// Mandate Creation Module
import IndexMandate from "./pages/Authorized/PGAS/Mandate/Index.vue";
import CreateMandate from "./pages/Authorized/PGAS/Mandate/Create.vue";

// Vendor Accreditation Module
import IndexVendor from "./pages/Authorized/PGAS/Vendors/Index.vue";
import CreateVendor from "./pages/Authorized/PGAS/Vendors/Create.vue";

//  Budget Allocation Module
import IndexBudgetAllocation from "./pages/Authorized/PGAS/BudgetAllocation/Index.vue";
import CreateBudgetAllocation from "./pages/Authorized/PGAS/BudgetAllocation/Create.vue";

// User Profile Settings
import EditUserProfile from "./pages/Authorized/PD/UserProfile/Edit.vue";

export default [
    {
        path: "/welcome",
        component: Welcome,
        name: "Welcome",
        meta: {
            requiresVisitor: true,
        },
    },
    {
        path: "/",
        component: Authorized,
        name: "Home",
        meta: {
            requiresAuth: true,
        },
        redirect: { name: "Dashboard" },
        children: [
            {
                path: "/",
                component: Dashboard,
                name: "Dashboard",
            },

            // MY NOTIFICATIONS
            {
                path: "/notifications",
                component: Notifications,
                name: "Notifications",
            },
            // ADMIN PATHS
            {
                path: "/admin",
                redirect: { name: "user_create" },
            },
            {
                path: "/admin/addUser",
                component: AddUser,
                name: "user_create",
            },

            // ACCOUNTS PATHS
            {
                path: "/accounts",
                component: IndexAccount,
                name: "account_index",
            },
            {
                path: "/accounts/create",
                component: CreateAccount,
                name: "account_create",
            },
            {
                path: "/accounts/:id",
                component: ShowAccount,
                name: "account_show",
            },
            // PROJECT PATHS
            {
                path: "/projects",
                component: IndexProject,
                name: "project_index",
            },
            {
                path: "/projects/create",
                component: CreateProject,
                name: "project_create",
            },
            {
                path: "/projects/:id",
                component: ShowProject,
                name: "project_show",
                props: true,
            },
                // PROJECT SPECIFIC ITEMS PATHS
                {
                    path: "/projects/:id/cost-estimate",
                    component: CostEstimate,
                    name: "cost_estimate_show"
                },
            // MANDATE PATHS
            {
                path: "/mandates",
                component: IndexMandate,
                name: "mandate_index",
            },
            {
                path: "/mandates/create",
                component: CreateMandate,
                name: "mandate_create",
            },
            // VENDOR PATHS
            {
                path: "/vendors",
                component: IndexVendor,
                name: "vendor_index",
            },
            {
                path: "/vendors/create",
                component: CreateVendor,
                name: "vendor_create",
            },
            // BUDGET ALLOCATION PATHS
            {
                path: "/budget-allocation",
                component: IndexBudgetAllocation,
                name: "budget_allocation_index",
            },
            {
                path: "/budget-allocation/create",
                component: CreateBudgetAllocation,
                name: "budget_allocation_create",
            },
            // USER PROFILE PATH
            {
                path: "/user-profile",
                component: EditUserProfile,
                name: "user_profile_edit",
            },
        ],
    },
];
