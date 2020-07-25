<template>
    <div class="container" id="container-post">
        <notifications group="foo" />

        <div class="row">
            <HeaderComponent v-if="user_id" />
            <div class="col-12 alert alert-success p-1" v-if="!user_id">
                <b>BIENVENIDOS A RED DE AUTOPARTES FARY</b>
                <br />
                <p>
                    Facilita buscar piezas o refacciones en negocios de su
                    localidad, ya no necesitara caminar negocio por negocio ni
                    hacer llamadas, solo para saber si tienen lo que busca.
                </p>
                <p>
                    Ofrece a los negocios de autopartes usadas clientes
                    potenciales y publicidad sin costo, registrándose al correo
                    faryseccionderegistros@gmail.com Además una sección de venta
                    de autos chocados, arrumbados o desvielados con membresía
                    gratuita por apertura
                </p>
                <p class="m-0 p-0">
                    <b>Active su ubicacion para gozar de nuestros servicios.</b>
                </p>
            </div>
            <div
                class="col-12 mt-0 pt-0 mt-4 text-center mb-3"
                v-if="type == 'owner' && user_id"
            >
                <div class="input-group">
                    <input
                        style="-webkit-border-radius: 50px;-moz-border-radius: 50px;border-radius: 50px;"
                        type="text"
                        v-model="busqueda"
                        class="form-control"
                        aria-label
                        placeholder="Buscar publicación"
                    />
                    <div class="input-group-append ml-2">
                        <button
                            @click="buscar()"
                            class="btn btn-success"
                            style="-webkit-border-radius: 50px;-moz-border-radius: 50px;border-radius: 50px;"
                        >
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4" v-if="!isBusqueda">
                <h4>
                    Crear Publicación
                    <button
                        type="button"
                        class="btn btn-light btn-sm"
                        data-toggle="tooltip"
                        data-placement="top"
                        :title="msgForm"
                        style="-webkit-border-radius: 50px;-moz-border-radius: 50px;border-radius: 50px;"
                    >
                        <i class="fas fa-question"></i>
                    </button>
                </h4>
                <div v-if="typePosts == 'posts'">
                    <PostCraeteComponent />
                </div>
                <div v-else>
                    <CarCreateComponent />
                </div>
            </div>

            <div v-if="isBusqueda" class="col-12 mt-3">
                <h4>Resultados de la busqueda '{{ busquedaAux }}'</h4>
                <button
                    @click="allPosts()"
                    class="btn btn-outline-danger btn-sm"
                >
                    <i class="fas fa-times"></i> Deshacer busqueda
                </button>
            </div>

            <div class="col-md-12 mt-4">
                <div v-if="typePosts == 'posts'">
                    <h4 style="display:inline" v-if="!isUrgentes">
                        <i class="fa fa-wrench"></i> Publicaciones de autopartes
                    </h4>
                    <h4 v-else style="display:inline">
                        <i class="fa fa-wrench"></i> Publicaciones de autopartes
                        urgentes
                    </h4>
                </div>
                <div v-else>
                    <h4>
                        <i class="fa fa-car"></i> Publicaciones de Autos
                        chocados
                    </h4>
                </div>
                <div class="text-right mb-3" v-if="typePosts == 'posts'">
                    <button
                        v-if="!isUrgentes"
                        class="btn btn-warning"
                        @click="loadPostUrgentes()"
                    >
                        <i class="fas fa-exclamation"></i> Ver publicaciones
                        urgentes
                    </button>
                    <button
                        v-if="isUrgentes"
                        @click="volverPostsNormales()"
                        class="btn btn-success"
                    >
                        <i class="fas fa-arrow-left"></i> Regresar
                    </button>
                </div>
                <div class="posts-container" v-if="!isLoading">
                    <div v-if="posts.length != 0">
                        <div
                            style="background-color: transparent; "
                            v-for="(p, index) in posts"
                            :key="p.id"
                        >
                            <img
                                @click="clickAd((index - 2) / 2)"
                                :src="ads[(index - 2) / 2].url"
                                class="text-center mb-3 w-100"
                                v-if="
                                    index - 2 >= 0 &&
                                        (index - 2) % 2 == 0 &&
                                        (index - 2) / 2 < ads.length
                                "
                            />

                            <PostComponent
                                :content="p.content"
                                :date="p.created_at"
                                :user="p.user_id"
                                :img="p.img"
                                :imgs="p.imgs"
                                :id="p.id"
                                :username="p.username"
                                :address="p.address"
                                :post_user_id="p.user_id"
                                :allComments="false"
                                :typePosts="typePosts"
                                :deleteUrl="defaultUrl"
                                @updateData="deletePost(index)"
                            />
                        </div>
                    </div>
                    <div
                        v-if="posts.length == 0 && isLoading == false"
                        class="text-center pt-5"
                    >
                        <h3>
                            Aún no se han hecho publicaciones
                        </h3>
                    </div>
                </div>
                <div v-else>
                    <LoaderComponent></LoaderComponent>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import PostComponent from "./PostComponent.vue";
import LoaderComponent from "./utils/LoaderComponent.vue";
import PostCraeteComponent from "./PostCreateComponent.vue";
import CarCreateComponent from "./CarCreateComponent";
import HeaderComponent from "./utils/HeaderComponent";

export default {
    props: ["typePosts"],
    watch: {},
    components: {
        PostComponent,
        LoaderComponent,
        PostCraeteComponent,
        CarCreateComponent,
        HeaderComponent
    },
    async mounted() {
        if (this.negocio) {
            this.negocio = JSON.parse(this.negocio);
        }
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        this.showName = !(
            this.type == "normal" &&
            this.isMyPosts &&
            this.typePosts == "posts"
        );

        if (this.typePosts == "posts") {
            this.defaultUrl = "/api/posts";
            this.msgForm =
                "Para una publicación de calidad escriba su pieza o refacción que busca, marca, submarca, si es nacional o extranjera y alguna descripción que complete la información";
        } else {
            this.defaultUrl = "/api/cars";
            this.msgForm =
                "Realiza tu anuncio detallando la marca, submarca, modelo, si es vehículo nacional o extranjero, factura original o refacturado y especifica la situación en la que se encuentre.";
        }
        let result = await navigator.permissions.query({ name: "geolocation" });

        if (result.state === "granted" || result.state == "prompt") {
            this.locationPermission = true;
        } else {
            /* console.log("emmit load ads"); */
            this.$emit("setLocation", null, null);
            this.locationPermission = false;
        }

        this.loadData();
    },
    data() {
        return {
            posts: [],
            isLoading: true,
            defaultUrl: "",
            currentPage: 1,
            firtsPageUrl: "",
            lastPageUrl: "",
            nextPageUrl: "",
            prevPageUrl: "",
            lastPage: 1,
            total: 1,
            path: "",
            isMyPosts: true,
            busqueda: "",
            busquedaAux: "",
            isBusqueda: false,
            locationPermission: false,
            showName: false,
            isSetLocation: false,
            publicacionesUrgentes: [],
            isUrgentes: false,
            urlDelete: "",
            msgForm: "",
            user_id: document.querySelector('meta[name="user_id"]')
                ? document
                      .querySelector('meta[name="user_id"]')
                      .getAttribute("content")
                : null,
            type: document.querySelector('meta[name="type"]')
                ? document
                      .querySelector('meta[name="type"]')
                      .getAttribute("content")
                : null,
            username: document.querySelector('meta[name="username"]')
                ? document
                      .querySelector('meta[name="username"]')
                      .getAttribute("content")
                : null,
            negocio: document.querySelector('meta[name="negocio"]')
                ? document
                      .querySelector('meta[name="negocio"]')
                      .getAttribute("content")
                : null
        };
    },
    computed: {
        ads() {
            return this.$store.getters.ads;
        }
    },
    methods: {
        loadPostUrgentes() {
            this.isUrgentes = true;
            this.isLoading = true;
            this.fetchData("api/posts/urgentes");
        },
        volverPostsNormales() {
            this.isLoading = true;
            this.fetchData(this.defaultUrl);
            this.isUrgentes = false;
        },
        clickAd(ad) {
            this.$emit("clickAd", ad);
        },
        loadData: async function(url = null, isBusqueda = false) {
            if (url == null) {
                url = this.defaultUrl;
            }
            this.isLoading = true;
            if (this.locationPermission && url == this.defaultUrl) {
                try {
                    await navigator.geolocation.getCurrentPosition(
                        location => {
                            let lat = location.coords.latitude;
                            let long = location.coords.longitude;

                            if (!this.isSetLocation) {
                                this.isSetLocation = true;
                                this.$emit("setLocation", lat, long);
                            }
                            this.defaultUrl = `${this.defaultUrl}/${lat}/${long}`;
                            this.fetchData(this.defaultUrl);
                            return;
                        },
                        error => {
                            this.locationPermission = false;
                            this.$emit("setLocation", null, null);
                            this.fetchData(url);
                            return;
                        }
                    );
                } catch (error) {
                    this.locationPermission = false;
                    this.$emit("setLocation", null, null);
                    this.fetchData(url);
                }
            } else {
                this.fetchData(url);
            }
        },
        fetchData(url) {
            fetch(url)
                .then(response => response.json())
                .then(json => {
                    let data = json.data || [];
                    let otros = json.otros || [];
                    let myposts = json.myposts || [];
                    this.posts = [...myposts, ...data, ...otros];
                    this.isLoading = false;

                    if (this.isBusqueda) {
                        Vue.notify({
                            group: "foo",
                            title: "Éxito",
                            text: "Busqueda completada",
                            type: "success"
                        });
                    }
                });
        },
        allPosts() {
            this.busqueda = "";
            this.loadData();
            this.isBusqueda = false;
            this.isMyPosts = false;
        },
        myPosts() {
            this.busqueda = "";
            this.loadData(this.defaultUrl + "/user/" + this.user_id);
            this.isBusqueda = false;
            this.isMyPosts = true;
        },

        deletePost(index) {
            this.posts.splice(index, 1);
        },
        buscar() {
            if (!this.busqueda) {
                Vue.notify({
                    group: "foo",
                    title: "Aviso",
                    text: "El campo de búsqueda no puede estar vacío",
                    type: "warn"
                });

                return;
            }
            this.isBusqueda = true;
            this.busquedaAux = this.busqueda;

            if (this.locationPermission) {
                navigator.geolocation.getCurrentPosition(
                    location => {
                        let lat = location.coords.latitude;
                        let long = location.coords.longitude;
                        let url = `api/search/${this.typePosts}/${this.busqueda}/${lat}/${long}`;
                        this.loadData(url, true);
                        return;
                    },
                    error => {
                        this.locationPermission = false;
                        let url = `api/search/${this.typePosts}/${this.busqueda}`;
                        this.loadData(url, true);
                        return;
                    }
                );
            } else {
                let url = `api/search/${this.typePosts}/${this.busqueda}`;
                this.loadData(url, true);
            }
        }
    }
};
</script>

<style>
#container-post {
    margin-bottom: 1%;
}

.title-page {
    font-weight: bold;
    margin-bottom: 1%;
    margin-top: 1.5%;
}

.container-tools {
    height: 30px;
}

.ad {
    background-color: transparent;
}

.parent {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: 1fr;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
}

.div1 {
    grid-area: 1 / 1 / 2 / 2;
    width: 10px;
}
.div2 {
    grid-area: 1 / 2 / 2 / 3;
}
</style>
