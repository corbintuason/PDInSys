require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'; Vue.use(VueRouter)
import BootstrapVue from 'bootstrap-vue'; Vue.use(BootstrapVue)
import PublicNavbar from './components/Guest/PublicNavbar.vue'; Vue.component('public-navbar', PublicNavbar);
import swal from 'sweetalert2'; window.swal = swal;
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;
import routes from "./routes";
import {store} from "./store/store";
import {globals} from "./store/globals";
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
});

Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue'));
const router = new VueRouter({
    mode: 'history',
    routes 
});

Vue.component('pagination', require('laravel-vue-pagination'));

import StepProgress from 'vue-step-progress';
Vue.component("step-progress", StepProgress);

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
