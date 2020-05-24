<template>
  <div class="mt-4 main">
    <div class="row">
      <div class="col-md-2 d-none d-md-block" id="s-1">
        <AdsComponent :ads="currentAds" />
      </div>
      <div class="col-md-8" id="s-2">
        <div class="container ml-3" id="container-post">
          <div class="row">
            <div class="col-md-8 col-12">
              <h1 class="title-page">Autos chocados</h1>
            </div>
            <div class="col-md-4 col-12">
              <a v-if="!user_id" class="btn btn-success text-white float-right" href="/cars/create">
                <i class="fa fa-plus"></i>
                Crear una publicación
              </a>

              <router-link v-else to="/cars/create" class="btn btn-success text-white float-right">
                <i class="fa fa-plus"></i>
                Crear una publicación
              </router-link>
            </div>

            <div class="col-12" v-if="user_id && !isBusqueda">
              <nav class="nav">
                <a @click="myPosts()" class="nav-link active" href="#">
                  <b v-if="isMyPosts">
                    <h4>Mis publicaciones</h4>
                  </b>
                  <span v-else>Mis publicaciones</span>
                </a>
                <a @click="allPosts()" class="nav-link" href="#">
                  <b v-if="!isMyPosts">
                    <h4>Todas las publicaciones</h4>
                  </b>
                  <span v-else>Todas las publicaciones</span>
                </a>
              </nav>
            </div>

            <div class="w-50">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-search"></i>
                  </span>
                </div>
                <input
                  type="text"
                  v-model="busqueda"
                  class="form-control"
                  aria-label
                  placeholder="Buscar publicación"
                />
                <div class="input-group-append">
                  <button @click="buscar()" class="btn btn-success">Buscar</button>
                </div>
              </div>
            </div>

            <div v-if="isBusqueda" class="col-12 mt-3">
              <h3>Resultados de la busqueda '{{busquedaAux}}'</h3>
              <button @click="allPosts()" class="btn btn-outline-danger">
                <i class="fas fa-times"></i> Deshacer busqueda
              </button>
            </div>

            <div class="col-md-12">
              <div class="posts-container" v-if="!isLoading">
                <br />
                <div v-if="cars.length != 0">
                  <div style="background-color: transparent" v-for="(c,index) in cars" :key="c.id">
                    <img
                      :src="currentAds[(index-2)/2].url"
                      width="100%"
                      v-if=" (index -2) >= 0 &&(index-2)% 2==0 && (index-2)/2 < currentAds.length  "
                      class="d-block d-md-none text-center mb-3"
                    />

                    <CarComponent
                      :content="c.content"
                      :username="c.username"
                      :post_user_id="c.user_id"
                      :date="c.created_at"
                      :imgs="c.imgs"
                      :id="c.id"
                    />
                  </div>
                </div>
                <div v-if="cars.length == 0 && isLoading == false" class="text-center pt-5">
                  <h3 v-if="!isMyPosts">Aún no se han hecho publicaciones</h3>
                  <h3 v-else>Aún no has hecho ninguna publicación</h3>
                </div>
              </div>
              <div v-else>
                <LoaderComponent></LoaderComponent>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2 d-none d-md-block" id="s-3">
        <NegociosComponent />
      </div>
    </div>
  </div>
</template>
<script>
import MenuIzquierdo from "./MenuIzquierdoComponent.vue";
import CarComponent from "./CarComponent.vue";
import LoaderComponent from "./utils/LoaderComponent.vue";
import AdsComponent from "./AdsComponent.vue";
import NegociosComponent from "./NegociosComponent.vue";

export default {
  components: {
    MenuIzquierdo,
    CarComponent,
    LoaderComponent,
    AdsComponent,
    NegociosComponent
  },
  async mounted() {
    this.isLoading = true;
    let result = await navigator.permissions.query({ name: "geolocation" });

    if (result.state === "granted" || result.state == "prompt") {
      this.locationPermission = true;
    } else {
      this.locationPermission = false;
    }
    if (this.user_id && this.type == "normal") {
      this.myPosts();
    } else {
      this.allPosts();
    }
    this.getAds();
  },
  data() {
    return {
      isLoading: true,
      cars: [],
      currentPage: 1,
      firtsPageUrl: "",
      lastPageUrl: "",
      nextPageUrl: "",
      prevPageUrl: "",
      lastPage: 1,
      total: 1,
      path: "",
      ads: [],
      currentAds: [],
      isMyPosts: true,
      busqueda: "",
      busquedaAux: "",
      isBusqueda: false,
      lat: null,
      long: null,
      locationPermission: false,
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content"),
      type: document.querySelector('meta[name="type"]')
        ? document.querySelector('meta[name="type"]').getAttribute("content")
        : null
    };
  },
  methods: {
    allPosts() {
      this.busqueda = "";
      this.loadData();
      this.isBusqueda = false;
      this.isMyPosts = false;
    },
    loadData: function(url = `/api/cars`) {
      this.isLoading = true;
      if (this.locationPermission && url == `/api/cars`) {
        navigator.geolocation.getCurrentPosition(
          location => {
            let lat = location.coords.latitude;
            let long = location.coords.longitude;
            url = `/api/cars/${lat}/${long}`;
            this.loadData(url);
            return;
          },
          error => {
            this.locationPermission = false;
            this.loadData();
            return;
          }
        );
        return;
      }
      fetch(url)
        .then(response => response.json())
        .then(json => {
          let data = json.data;
          this.cars = data.data;
          this.currentPage = data.current_page;
          this.firtsPageUrl = data.first_page_url;
          this.lastPage = data.last_page;
          this.nextPageUrl = data.next_page_url;
          this.prevPageUrl = data.prev_page_url;
          this.isLoading = false;
          this.total = Math.ceil(data.total / data.per_page);
          this.path = data.path;
        });
    },
    myPosts() {
      this.busqueda = "";
      this.loadData("/api/cars/user/" + this.user_id);
      this.isBusqueda = false;
      this.isMyPosts = true;
    },
    buscar() {
      this.isBusqueda = true;
      this.busquedaAux = this.busqueda;
      if (this.locationPermission) {
        navigator.geolocation.getCurrentPosition(
          location => {
            let lat = location.coords.latitude;
            let long = location.coords.longitude;
            let url = `/api/cars/search/${this.busqueda}/${lat}/${long}`;
            this.loadData(url);
            return;
          },
          error => {
            this.locationPermission = false;
            let url = `/api/cars/search/${this.busqueda}`;
            this.loadData(url);
            return;
          }
        );
      } else {
        let url = `/api/cars/search/${this.busqueda}`;
        this.loadData(url);
      }
    },
    getAds() {
      this.isLoading = true;
      fetch("/api/ads")
        .then(response => response.json())
        .then(json => {
          this.ads = json.data;

          if (this.ads.length >= 3) {
            this.canUpdate = true;
            for (let i = 0; i <= 3; i++) {
              this.currentAds.push(this.ads.pop());
            }
          } else {
            while (this.ads.length > 0) {
              this.currentAds.push(this.ads.pop());
            }
          }
          this.isLoading = false;
        });
    },

    getRandom() {
      return this.ads[Math.floor(Math.random() * this.ads.length)];
    },
    shuffle(array) {
      array.sort(() => Math.random() - 0.5);
    }
  }
};
</script>

<style>
#container-post {
  height: 80vh;
  margin-bottom: 10%;
  overflow-y: scroll;
}

.container-tools {
  height: 30px;
}
</style>