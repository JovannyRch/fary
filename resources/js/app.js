

require("./bootstrap");

import router from "./assets/router";
import Vuetify from "vuetify";
const app = new Vue({
    el: "#app",
    router,
    vuetify: new Vuetify(),


});

