import Welcome from "./pages/Welcome";
import Authorized from "./pages/Authorized.vue"
import Dashboard from "./pages/Authorized/Dashboard.vue"
import AddUser from "./pages/Authorized/Admin/AddUser.vue"


import CreateAccount from "./pages/Authorized/PGOS/Accounts/Create.vue"
import IndexAccount from "./pages/Authorized/PGOS/Accounts/Index.vue"
import ShowAccount from "./pages/Authorized/PGOS/Accounts/Show.vue"
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
        path: '/',
        component: Authorized,
        name: 'Home',
        meta: {
            requiresAuth: true
        },
        redirect: { name: 'Dashboard'},
        children:[
            {
                path: "/",
                component: Dashboard,
                name: 'Dashboard'
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
        component: IndexAccount,
        name: "account_index",
    },
    {
        path: '/accounts/create',
        component: CreateAccount,
        name: "account_create"
    },
    {
        path: '/accounts/:id',
        component: ShowAccount,
        name: "account_show"
    }
        ]
    },

  

]