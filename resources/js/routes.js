const TaskCreate = () => import('./components/Tasks/Add.vue')
const TaskEdit = () => import('./components/Tasks/Edit.vue')
const Login = () => import('./Pages/Auth/Login.vue')
const Logout = () => import('./Pages/Auth/Logout.vue')
const Register = () => import('./Pages/Auth/Register.vue')
const Home = () => import('./Pages/Home.vue')

export const routes = [
    {
        name: 'taskEdit',
        path: '/task/:id/edit',
        component: TaskEdit,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'taskAdd',
        path: '/task/add',
        component: TaskCreate,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'Logout',
        path: '/logout',
        component: Logout,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'Login',
        path: '/login',
        component: Login,
        meta: {
            requiresAuth: false
        }
    },
    {
        name: 'Register',
        path: '/register',
        component: Register,
        meta: {
            requiresAuth: false
        }
    },

    {
        name: 'Home',
        path: '/',
        component: Home,
    }
]