import Welcome from './components/WelcomeComponent.vue'
import Login from './components/auth/Login.vue'
import Register from './components/auth/Register.vue'
import CreateTags from './components/CreateTagsComponent.vue'
import SetTags from './components/SetTagsComponent.vue'
// import Edit from './components/EditComponent.vue'
export default {
    mode: 'history',
    base: '/',
    fallback: true,
    routes: [
        {
            path: '/',
            component: Welcome,
            name: 'Welcome',
            meta: {requiresAuth: true}
        },
        {
            path: '/login',
            component: Login,
            name: 'login',
            meta: {guest: true}
        },
        {
            path: '/register',
            component: Register,
            name: 'register',
            meta: {guest: true}
        },
        {
            path: '/createTags',
            component: CreateTags,
            name: 'createtags',
            meta: {requiresAuth: false}
        },
        {
            path: '/setTags',
            component: SetTags,
            name: 'settags',
            meta: {requiresAuth: false}
        },
        // {
        //     name: 'edit',
        //     path: '/edit/:id',
        //     component: Edit,
        //     meta: {requiresAuth: true}
        // },
    ]
}