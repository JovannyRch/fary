<template>
  <div class="container" id="container-post">
    <notifications group="foo" />

    <div class="row">
      <HeaderComponent v-if="user_id" />
      <div class="col-12 alert alert-success p-3" v-if="!user_id">
        <b>BIENVENIDOS A RED DE AUTOPARTES FARY</b>
        <br />
        <p>
          Estamos para servirle, puede buscar piezas o refacciones en negocios de su localidad, ya no necesitara ir negocio por negocio ni hacer llamadas solo para saber si tienen lo que busca.
          Para los negocios de Auto Partes Usadas veran lo que buscan los clientes de su zona ademas de ver los autos chocados, arrumbados o desvielados que hay a la venta en su comunidad.
        </p>
        <p>Active su ubicacion para gozar de nuestros servicios.</p>
      </div>
      <div class="col-12 mt-0 pt-0 mt-4 text-center mb-3" v-if="type == 'owner' && user_id">
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

      <div class="col-12" v-if="!isBusqueda && (type ==='owner' && typePosts=='cars')">
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
        <h4>Resultados de la busqueda '{{busquedaAux}}'</h4>
        <button @click="allPosts()" class="btn btn-outline-danger btn-sm">
          <i class="fas fa-times"></i> Deshacer busqueda
        </button>
      </div>

      <div class="col-md-12 mt-4">
        <div v-if="typePosts == 'posts'">
          <h4 v-if="type == 'normal' && isMyPosts">
            <i class="fa fa-wrench"></i> Mis Publicaciones de Autopartes
          </h4>
          <h4 v-else>
            <i class="fa fa-wrench"></i> Publicaciones de autopartes
          </h4>
        </div>
        <div v-else>
          <h4 v-if="type == 'normal' && isMyPosts">
            <i class="fa fa-car"></i>
            Mis Publicaciones de Autos chocados
          </h4>
          <h4 v-else>
            <i class="fa fa-car"></i>
            Publicaciones de Autos chocados
          </h4>
        </div>

        <div class="posts-container" v-if="!isLoading">
          <div v-if="posts.length != 0">
            <div style="background-color: transparent; " v-for="(p,index) in posts" :key="p.id">
              <img
                :src="ads[(index-2)/2].url"
                v-if=" (index -2) >= 0 &&(index-2)% 2==0 && (index-2)/2 < ads.length  "
                class="d-block d-md-none text-center mb-3 w-100"
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
                :showName="showName"
                :allComments="false"
                :typePosts="typePosts"
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
import CarCreateComponent from "./CarCreateComponent";
import HeaderComponent from "./utils/HeaderComponent";

export default {
  props: ["ads", "typePosts"],
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
      this.$emit("setLocation", null, null);
      this.locationPermission = false;
    }

    if (this.user_id && this.type == "normal" && this.typePosts == "posts") {
      this.myPosts();
    } else {
      this.allPosts();
    }
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

      msgForm: "",
      user_id: document.querySelector('meta[name="user_id"]')
        ? document.querySelector('meta[name="user_id"]').getAttribute("content")
        : null,
      type: document.querySelector('meta[name="type"]')
        ? document.querySelector('meta[name="type"]').getAttribute("content")
        : null,
      username: document.querySelector('meta[name="username"]')
        ? document
            .querySelector('meta[name="username"]')
            .getAttribute("content")
        : null,
      negocio: document.querySelector('meta[name="negocio"]')
        ? document.querySelector('meta[name="negocio"]').getAttribute("content")
        : null
    };
  },
  methods: {
    loadData: async function(url = null, isBusqueda = false) {
      console.log("cargando todas las notificaciones");
      if (url == null) {
        url = this.defaultUrl;
      }
      this.isLoading = true;
      if (this.locationPermission && url == this.defaultUrl) {
        await navigator.geolocation.getCurrentPosition(
          location => {
            let lat = location.coords.latitude;
            let long = location.coords.longitude;
            if (!this.isSetLocation) {
              this.isSetLocation = true;
              this.$emit("setLocation", lat, long);
            }
            let url = `${this.defaultUrl}/${lat}/${long}`;
            this.loadData(url);
            return;
          },
          error => {
            this.locationPermission = false;
            this.loadData();
            return;
          }
        );
      }
      console.log("Ahora si");
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

          if (isBusqueda) {
            Vue.notify({
              group: "foo",
              title: "Busqueda completada",
              text: "success"
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
            let url = `${this.defaultUrl}/search/${this.busqueda}/${lat}/${long}`;
            this.loadData(url, true);
            return;
          },
          error => {
            this.locationPermission = false;
            let url = `${this.defaultUrl}/search/${this.busqueda}`;
            this.loadData(url, true);
            return;
          }
        );
      } else {
        let url = `${this.defaultUrl}/search/${this.busqueda}`;
        this.loadData(url, true);
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