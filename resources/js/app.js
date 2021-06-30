require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router'
import routes from './rotas'

Vue.use(VueRouter)
const router = new VueRouter(routes)

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})

import Swal from 'sweetalert2'
window.Swal = Swal


function loggedIn(){
    return localStorage.getItem('token')
    console.log('nao logado')
}


router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // Esta routa requer auth, checa se esta logado
        // Se nao redireciona para a pagina de login
        if (!loggedIn()) {
            next({
            path: '/login',
            query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        if (loggedIn()) {
            next({
            path: '/',
            query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // tenha certeza que sempre deve chamar next()!
    }
})


const app = new Vue({
    el: '#app',
    router
});
