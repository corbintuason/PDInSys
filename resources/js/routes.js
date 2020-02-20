import Welcome from "./pages/Welcome";
import Dashboard from "./pages/Authorized/Dashboard.vue"
import AddUser from "./pages/Authorized/Admin/AddUser.vue"
import CreateAccount from "./pages/Authorized/PGOS/Accounts/Create.vue"
export default [
    {
        path: '/',
        component: Welcome,
        name: 'Welcome',
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: 'Dashboard',
        meta: {
            requiresAuth: true
        }
    },

    // ADMIN PATHS
    {
        path: '/admin',
        redirect: { name: 'user_create' }
    },
    {
        path: '/admin/addUser',
        component: AddUser,
        name: "user_create"
    },

    // ACCOUNTS PATHS
    {
        path: "/accounts",
        redirect: { name: 'account_index'}
    },
    {
        path: '/accounts/create',
        component: CreateAccount,
        name: "account_create"
    }

]