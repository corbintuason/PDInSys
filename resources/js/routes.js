import Welcome from "./pages/Welcome";
import Dashboard from "./pages/Authorized/Dashboard.vue"
import AddUser from "./pages/Authorized/Admin/AddUser.vue"

export default [
    {
        path: '/',
        component: Welcome,
        name: 'Welcome',
        meta:{
            requiresVisitor: true
        }
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: 'Dashboard',
        meta:{
            requiresAuth: true
        }
    },

    // ADMIN PATHS
    {
        path: '/admin/addUser',
        component: AddUser,
        name: "Add User"
    }
]