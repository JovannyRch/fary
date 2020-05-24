<template>
  <div class="container ml-2" id="container-post">
    <div class="row">
      <div class="col-md-8 col-12">
        <h1 class="title-page">Autopartes</h1>
      </div>
      <div class="col-md-4 col-12">
        <a v-if="!user_id" class="btn btn-success text-white float-right" href="/posts/create">
          <i class="fa fa-plus"></i>
          Crear una publicación
        </a>

        <router-link v-else to="/posts/create" class="btn btn-success text-white float-right">
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

          <div v-if="posts.length != 0">
            <div style="background-color: transparent" v-for="(p,index) in posts" :key="p.id">
              <img
                :src="ads[(index-2)/2].url"
                width="100%"
                v-if=" (index -2) >= 0 &&(index-2)% 2==0 && (index-2)/2 < ads.length  "
                class="d-block d-md-none text-center mb-3"
              />

              <PostComponent
                :content="p.content"
                :date="p.created_at"
                :user="p.user_id"
                :img="p.img"
                :id="p.id"
                :username="p.username"
                :post_user_id="p.user_id"
                @updateData="deletePost(index)"
              />
            </div>
          </div>
          <div v-if="posts.length == 0 && isLoading == false" class="text-center pt-5">
            <h3 v-if="!isMyPosts">Aún no se han hecho publicaciones</h3>
            <h3 v-else>Aún no has ninguna publicación</h3>
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

export default {
  props: ["ads"],
  components: {
    PostComponent,
    LoaderComponent
  },
  async mounted() {
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
  },
  data() {
    return {
      isLoading: true,
      posts: [],
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
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content"),
      type: document.querySelector('meta[name="type"]')
        ? document.querySelector('meta[name="type"]').getAttribute("content")
        : null
    };
  },
  methods: {
    loadData: async function(url = `/api/posts`) {
      this.isLoading = true;
      if (this.locationPermission && url == `/api/posts`) {
        navigator.geolocation.getCurrentPosition(
          location => {
            let lat = location.coords.latitude;
            let long = location.coords.longitude;
            url = `/api/posts/${lat}/${long}`;
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
          this.posts = data.data;
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

    allPosts() {
      this.busqueda = "";
      this.loadData();
      this.isBusqueda = false;
      this.isMyPosts = false;
    },
    myPosts() {
      this.busqueda = "";
      this.loadData("/api/posts/user/" + this.user_id);
      this.isBusqueda = false;
      this.isMyPosts = true;
    },

    deletePost(index) {
      this.posts.splice(index, 1);
    },
    buscar() {
      this.isBusqueda = true;
      this.busquedaAux = this.busqueda;
      if (this.locationPermission) {
        navigator.geolocation.getCurrentPosition(
          location => {
            let lat = location.coords.latitude;
            let long = location.coords.longitude;
            let url = `/api/posts/search/${this.busqueda}/${lat}/${long}`;
            this.loadData(url);
            return;
          },
          error => {
            this.locationPermission = false;
            let url = `/api/posts/search/${this.busqueda}`;
            this.loadData(url);
            return;
          }
        );
      } else {
        let url = `/api/posts/search/${this.busqueda}`;
        this.loadData(url);
      }
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
</style>