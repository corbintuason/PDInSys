import Welcome from "./pages/Welcome";
import Authorized from "./pages/Authorized.vue";
import Dashboard from "./pages/Authorized/Dashboard.vue";
import AddUser from "./pages/Authorized/ADMIN/AddUser.vue";

// Account and Client Accreditation
import CreateAccount from "./pages/Authorized/PGOS/Accounts/Create.vue";
import IndexAccount from "./pages/Authorized/PGOS/Accounts/Index.vue";
import ShowAccount from "./pages/Authorized/PGOS/Accounts/Show.vue";

// Project Creation Module
import IndexProject from "./pages/Authorized/PGOS/Projects/Index.vue";
import CreateProject from "./pages/Authorized/PGOS/Projects/Create.vue";

// Vendor Accreditation Module
import IndexVendor from "./pages/Authorized/PGAS/Vendors/Index.vue";

// User Profile Settings
import EditUserProfile from "./pages/Authorized/PD/UserProfile/Edit.vue";

export default [
    {
        path: "/welcome",
        component: Welcome,
        name: "Welcome",
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: "/",
        component: Authorized,
        name: "Home",
        meta: {
            requiresAuth: true
        },
        redirect: { name: "Dashboard" },
        children: [
            {
                path: "/",
                component: Dashboard,
                name: "Dashboard"
            },
            // ADMIN PATHS
            {
                path: "/admin",
                redirect: { name: "user_create" }
            },
            {
                path: "/admin/addUser",
                component: AddUser,
                name: "user_create"
            },

            // ACCOUNTS PATHS
            {
                path: "/accounts",
                component: IndexAccount,
                name: "account_index"
            },
            {
                path: "/accounts/create",
                component: CreateAccount,
                name: "account_create"
            },
            {
                path: "/accounts/:id",
                component: ShowAccount,
                name: "account_show"
            },
            // PROJECT PATHS
            {
                path: "/projects",
                component: IndexProject,
                name: "project_index"
            },
            {
                path: "/projects/create",
                component: CreateProject,
                name: "project_create"
            },
            // VENDOR PATHS
            {
                path: "/vendors",
                component: IndexVendor,
                name: "vendor_index"
            },
            // USER PROFILE PATH
            {
                path: "/user-profile",
                component: EditUserProfile,
                name: "user_profile_edit"
            }
        ]
    }
];
