require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'; Vue.use(VueRouter)
import BootstrapVue from 'bootstrap-vue'; Vue.use(BootstrapVue)
import PublicNavbar from './components/Guest/PublicNavbar.vue'; Vue.component('public-navbar', PublicNavbar);
import swal from 'sweetalert2'; window.swal = swal;
import routes from "./routes";
import {store} from "./store/store";

Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue'));
const router = new VueRouter({
    mode: 'history',
    routes 
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!store.getters.loggedIn) {
        next({
          name: 'Welcome',
        })
      } else {
        next()
      }
    }else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters.loggedIn) {
          next({
            name: 'Dashboard',
          })
        } else {
          next()
        }
      } else {
      next() 
    }
  })
import App from "./App.vue";

// new Vue({
//     router,
//     render: h => h(App)
// }).$mount('#app');

const app = new Vue({
    el: '#app',
    store: store,
    router,
});
