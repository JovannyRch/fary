<template>
  <div class="container" id="container-post">
    <div class="row">
      <div class="col-8 offset-2 mt-0 pt-0 text-center" v-if="type == owner">
        <div class="input-group">
          <input
            style="-webkit-border-radius: 50px;-moz-border-radius: 50px;border-radius: 50px;"
            type="text"
            v-model="busqueda"
            class="form-control"
            aria-label
            placeholder="Buscar publicación"
          />
          <div class="input-group-append ml-2" v-show="busqueda">
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

      <div class="col-12" v-if="!isBusqueda">
        <h6 style="color:grey;">
          Crear publicación
          <button
            type="button"
            class="btn btn-light btn-sm"
            data-toggle="tooltip"
            data-placement="top"
            title="Para una publicación de calidad escriba su pieza o refacción que busca, marca, submarca, si es nacional o extranjera y alguna descripción que complete la información"
            style="-webkit-border-radius: 50px;-moz-border-radius: 50px;border-radius: 50px;"
          >
            <i class="fas fa-question"></i>
          </button>
        </h6>
        <PostCraeteComponent></PostCraeteComponent>
      </div>

      <div v-if="isBusqueda" class="col-12 mt-3">
        <h3>Resultados de la busqueda '{{busquedaAux}}'</h3>
        <button @click="allPosts()" class="btn btn-outline-danger btn-sm">
          <i class="fas fa-times"></i> Deshacer busqueda
        </button>
      </div>

      <div class="col-md-12 mt-4">
        <h4 style="color:grey;" v-if="type == 'normal' && isMyPosts">Mis Publicaciones de Autopartes</h4>
        <h4 v-else>Publicaciones de autopartes</h4>

        <div class="posts-container" v-if="!isLoading">
          <div v-if="posts.length != 0">
            <div style="background-color: transparent; " v-for="(p,index) in posts" :key="p.id">
              <img
                :src="ads[(index-2)/2].url"
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
                :address="p.address"
                :post_user_id="p.user_id"
                :showName="showName"
                @updateData="deletePost(index)"
              />
            </div>
          </div>
          <div v-if="posts.length == 0 && isLoading == false" class="text-center pt-5">
            <h3 v-if="!isMyPosts">Aún no se han hecho publicaciones</h3>
            <h3 v-if="isMyPosts">Aún no has ninguna publicación</h3>
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

export default {
  props: ["ads"],
  components: {
    PostComponent,
    LoaderComponent,
    PostCraeteComponent
  },
  async mounted() {
    $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
    this.showName = !(this.type == "normal" && this.isMyPosts);
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
      showName: false,
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