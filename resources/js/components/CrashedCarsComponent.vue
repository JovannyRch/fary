<template>
  <div class="mt-4 main">
    <div class="row">
      <!--  <div class="col-md-2" id="s-1">
        <AdsComponent />
      </div>-->
      <div class="col-md-8 offset-md-1" id="s-2">
        <div class="container" id="container-post">
          <div class="row">
            <div class="col-md-8 col-12">
              <h1 class="title-page">Autos chocados</h1>
            </div>
            <div class="col-md-4 col-12">
              <a class="btn btn-success text-white float-right" href="/cars/create">
                <i class="fa fa-plus"></i>
                Crear una publicación
              </a>
            </div>

            <div class="col-md-12">
              <div class="posts-container" v-if="!isLoading">
                <br />

                <CarComponent
                  v-for="c in cars"
                  :content="c.content"
                  :username="c.username"
                  :post_user_id="c.user_id"
                  :date="c.created_at"
                  :imgs="c.imgs"
                  :key="c.id"
                  :id="c.id"
                />
              </div>
              <div v-else>
                <LoaderComponent></LoaderComponent>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2" id="s-3">
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
      path: ""
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
</style>