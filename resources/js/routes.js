import { store } from "./store/store";

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

import ShowBudgetRequest from "./pages/Authorized/Common/BudgetRequest/Show.vue";

import ShowCostEstimate from "./pages/Authorized/PGOS/CostEstimate/Show.vue";
import IndexProjectBudgetRequest from "./pages/Authorized/PGOS/ProjectBudgetRequest/Index.vue";
import CreateProjectBudgetRequest from "./pages/Authorized/PGOS/ProjectBudgetRequest/Create.vue";

import IndexProjectRequestForPayment from "./pages/Authorized/PGOS/ProjectRequestForPayment/Index.vue";
import CreateERFP from "./pages/Authorized/Common/RFP/Create";
import ShowRFP from "./pages/Authorized/Common/RFP/Show";



// PGAS


// Mandate Creation Module
import IndexMandate from "./pages/Authorized/PGAS/Mandate/Index.vue";
import CreateMandate from "./pages/Authorized/PGAS/Mandate/Create.vue";
import ShowMandate from "./pages/Authorized/PGAS/Mandate/Show.vue";

// Vendor Accreditation Module
import IndexVendor from "./pages/Authorized/PGAS/Vendors/Index.vue";
import CreateVendor from "./pages/Authorized/PGAS/Vendors/Create.vue";
import ShowVendor from "./pages/Authorized/PGAS/Vendors/Show.vue";

//  Budget Allocation Module
import IndexBudgetAllocation from "./pages/Authorized/PGAS/BudgetAllocation/Index.vue";
import CreateBudgetAllocation from "./pages/Authorized/PGAS/BudgetAllocation/Create.vue";
import ShowBudgetAllocation from "./pages/Authorized/PGAS/BudgetAllocation/Show.vue";

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
                beforeEnter(to, from, next){
                    // if (!store.getters["auth"].hasAbility("view-all", "App\\Account")) {
                        if(!store.getters["auth/hasRouteAbility"]("view-all", "App\\Account")){
                        next({
                            name: "Welcome",
                        });
                    } else {
                        next();
                    }
                }
            },
            {
                path: "/accounts/create",
                component: CreateAccount,
                name: "account_create",
                beforeEnter(to, from, next){
                    if(!store.getters["auth/hasRouteAbility"]("create", "App\\Account")){
                        next({
                            name: "Welcome",
                        });
                    } else {
                        next();
                    }
                }
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
                component: ShowCostEstimate,
                name: "cost_estimate_show",
            },
            {
                path: "/projects/:id/budget-requests",
                component: IndexProjectBudgetRequest,
                name: "project_budget_request_index",
            },
            {
                path: "/projects/:id/budget-requests/create",
                component: CreateProjectBudgetRequest,
                name: "project_budget_request_create",
                // beforeEnter(to, from, next){
                //     if(!store.getters["auth/hasAbility"]("create", "App\\BudgetRequest")){
                //         next({
                //             name: "Welcome",
                //         });
                //     } else {
                //         next();
                //     }
                // }
            },

            {
                path: "/projects/:id/rfps",
                component: IndexProjectRequestForPayment,
                name: "project_rfp_index",
            },

            {
                path: "/projects/:id/rfps/create",
                component: CreateERFP,
                name: "project_rfp_create",
            },
            
            // ERFP Paths

            {
                path: '/erfps/create',
                component: CreateERFP,
                name: 'erfp_create'
            },

            // BUDGET REQUEST PATHS
            {
                path: "/budget-requests/:id/",
                component: ShowBudgetRequest,
                name: "budget_request_show",
            },
            
            // RFP PATHS
            {
                path: "/erfps/:id",
                component: ShowRFP,
                name: "rfp_show"
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
            {
                path: "/mandates/:id",
                component: ShowMandate,
                name: "mandate_show",
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
            {
                path: "/vendors/:id",
                component: ShowVendor,
                name: "vendor_show",
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
            {
                path: "/budget-allocation/:id",
                component: ShowBudgetAllocation,
                name: "budget_allocation_show",
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
