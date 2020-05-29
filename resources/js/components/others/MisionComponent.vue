<template>
  <div class="mt-4 main">
    <notifications group="foo" />
    <div class="row">
      <div class="col-md-2 d-none d-md-block">
        <AdsComponent :ads="currentAds" />
      </div>
      <div class="col-md-8 col-10 offset-1 offset-md-0 pt-0 pl-3 pr-3">
        <div class="text-center">
          <div class="text-left">
            <a @click="$router.go(-1)" href="#" class="btn btn-outline-secondary mb-3">
              <i class="fas fa-arrow-left"></i> Regresar
            </a>
          </div>

          <div class="card">
            <div class="card-header">
              <h2>
                <i class="fas fa-bookmark"></i> Misión
              </h2>
            </div>
            <div class="card-body">
              <div class="text-justify">
                <div class="row">
                  <div class="col-md-3 col-12 text-center">
                    <img class="card-img-top w-75" src="/images/logo.jpg" alt />
                  </div>
                  <div class="col-md-9 col-12 p-4">
                    <h5>Inovando para conectar clientes y negocios, de una manera rapida, eficaz y segura, en la compra de refacciones de uso.</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2 d-none d-md-block">
        <NegociosComponent />
      </div>
    </div>
  </div>
</template>

<script>
import AdsComponent from "./../AdsComponent.vue";
import NegociosComponent from "./../NegociosComponent.vue";

export default {
  components: {
    AdsComponent,
    NegociosComponent
  },
  data() {
    return {
      ads: [],
      currentAds: [],
      isLoading: false,
      latitud: null,
      longitud: null,
      url: "/api/ads"
    };
  },
  mounted() {
    this.getAds();
  },
  methods: {
    setLocation(lat, long) {
      console.log("Seteando location");
      if (lat && long) {
        this.latitud = lat;
        this.longitud = long;
        this.url = "/api/ads/" + lat + "/" + long;
      }

      this.getAds();
    },
    getAds() {
      this.isLoading = true;
      fetch(this.url)
        .then(response => response.json())
        .then(json => {
          this.ads = json.data;
          console.log(json);
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
</style>