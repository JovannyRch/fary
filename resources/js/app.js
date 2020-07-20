require("./bootstrap");

import router from "./assets/router";
import store from "./store/store";
const app = new Vue({
    el: "#app",
    router,
    store
});
