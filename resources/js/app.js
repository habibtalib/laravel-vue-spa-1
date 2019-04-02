import "es6-promise/auto";
import axios from "axios";
import "./bootstrap";
import Vue from "vue";
import VueAuth from "@websanova/vue-auth";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";
import Index from "./Index";
import auth from "./auth";
import router from "./router";
import Vuetify from "vuetify";
import VueQrcodeReader from "vue-qrcode-reader";
import TreeChart from "vue-tree-chart";
import VueCarousel from 'vue-carousel';
import Vuex from "vuex";
import store from "./store/index.js";
// import VueCarousel from "@chenfengyuan/vue-carousel";
// if ("serviceWorker" in navigator) {
//     navigator.serviceWorker.register("/sw.js");
// }

Vue.use(VueQrcodeReader);
Vue.use(VueCarousel);
Vue.use(TreeChart);
Vue.use(Vuex);
// Set Vue globally
window.Vue = Vue;

// Set Vue router
Vue.router = router;
Vue.use(VueRouter);
Vue.use(Vuetify, {
    theme: {
        primary: "#3f51b5",
        secondary: "#b0bec5",
        accent: "#8c9eff",
        error: "#b71c1c"
    }
});
// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `/api`;
Vue.use(VueAuth, auth);

// Load Index
Vue.component("index", Index);

const app = new Vue({
    el: "#app",
    // render: h => h(app),
    router,
    store
});
