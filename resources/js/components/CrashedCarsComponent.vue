<template>
  <div class="mt-4 main">
    <div class="row">
      <div class="col-md-2 d-none d-md-block" id="s-1">
        <AdsComponent :ads="currentAds" />
      </div>
      <div class="col-md-8" id="s-2">
        <div class="container" id="container-post">
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

            <div class="col-md-12">
              <div class="posts-container" v-if="!isLoading">
                <br />
                <div v-if="cars.length != 0">
                  <div style="background-color: transparent" v-for="(c,index) in cars" :key="c.id">
                    <img
                      :src="currentAds[(index-2)/2].url"
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
                <div v-else class="text-center pt-5">
                  <h3>Aún no se han hecho publicaciones</h3>
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
  mounted() {
    this.loadData();
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
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content")
    };
  },
  methods: {
    loadData: function(url = `/api/cars`) {
      this.isLoading = true;
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