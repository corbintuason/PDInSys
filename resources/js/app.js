require("./bootstrap");

window.Vue = require("vue");

// Vue Router
import VueRouter from "vue-router";
Vue.use(VueRouter);

// Bootstrap Vue
import BootstrapVue from "bootstrap-vue";
Vue.use(BootstrapVue);

// Vue Particles
import VueParticles from "vue-particles";
Vue.use(VueParticles);

// Vue Timeline
import VerticalTimeline from "vue-vertical-timeline";
Vue.use(VerticalTimeline);

import PublicNavbar from "./components/guest/PublicNavbar.vue";
Vue.component("public-navbar", PublicNavbar);

import Notifications from "vue-notification";
Vue.use(Notifications);

import Vuelidate from "vuelidate";
Vue.use(Vuelidate);

import swal from "sweetalert2";
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: "bottom-end",
    timer: null,
});

window.toast = toast;
import routes from "./routes";
import { store } from "./store/store";
import { globals } from "./store/globals";
import VueProgressBar from "vue-progressbar";

Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    failedColor: "red",
    height: "2px",
});

import ClipLoader from 'vue-spinner/src/ClipLoader.vue'
Vue.component('clip-loader', ClipLoader);

Vue.component("pagination", require("laravel-vue-pagination"));

import StepProgress from "vue-step-progress";
Vue.component("step-progress", StepProgress);

import itemProgress from "./components/authorized/public/ItemProgress.vue";
Vue.component("item-progress", itemProgress);

const router = new VueRouter({
    mode: "history",
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
            next({
                name: "Welcome",
            });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.requiresVisitor)) {
        if (store.getters.loggedIn) {
            next({
                name: "Dashboard",
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

const app = new Vue({
    el: "#app",
    store: store,
    router,
});
