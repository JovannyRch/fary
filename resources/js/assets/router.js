window.Vue = require("vue");
import VueRouter from "vue-router";

// Librerias
import imageViewer from "image-viewer-vue";
import Notifications from "vue-notification";

Vue.use(Notifications);

Vue.use(imageViewer);

import PostsComponent from "../components/PostsComponent.vue";
import HomeComponent from "../components/HomeComponent.vue";
import PostCreateComponent from "../components/PostCreateComponent.vue";
import PostShowComponent from "../components/PostShowComponent.vue";
import PostCarShowComponent from "../components/PostCarShowComponent.vue";
import CrashedCardComponent from "../components/CrashedCarsComponent.vue";
import CarCreateComponent from "../components/CarCreateComponent.vue";

import PrivacyComponent from "../components/others/PrivacyComponent.vue";
import MisionComponent from "../components/others/MisionComponent.vue";
import VisionComponent from "../components/others/VisionComponent.vue";
import HelpComponent from "../components/others/HelpComponent.vue";
import ZonaComponent from "../components/others/ZonaComponent.vue";
import ZonaShowComponent from "../components/others/ZonaShowComponent.vue";
import MasComponent from "../components/others/MasComponent.vue";
Vue.use(VueRouter);
const router = new VueRouter({
    mode: "history",
    routes: [
        //  { path: "/", component: PostListComponent },
        { path: "/", component: HomeComponent, name: "home" },
        {
            path: "/posts/create",
            component: PostCreateComponent,
            name: "post-create"
        },
        { path: "/post/:id", component: PostShowComponent, name: "post-show" },
        { path: "/cars", component: CrashedCardComponent, name: "cars" },
        { path: "/car/:id", component: PostCarShowComponent, name: "car-show" },
        {
            path: "/cars/create",
            component: CarCreateComponent,
            name: "cars-create"
        },
        { path: "/mision", component: MisionComponent, name: "mision" },
        {
            path: "/aviso-privacidad",
            component: PrivacyComponent,
            name: "aviso-privacidad"
        },
        { path: "/vision", component: VisionComponent, name: "vision" },
        { path: "/ayuda", component: HelpComponent, name: "ayuda" },
        { path: "/zona-publicitaria", component: ZonaComponent, name: "zona" },
        {
            path: "/zona-publicitaria/:id",
            component: ZonaShowComponent,
            name: "zona-show"
        },
        { path: "/mas", component: MasComponent, name: "mas" }
    ]
});

export default router;
