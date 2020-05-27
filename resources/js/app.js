

require("./bootstrap");

import router from "./assets/router";
const app = new Vue({
    el: "#app",
    router,
});

