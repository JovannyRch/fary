<template>
  <div class="mt-4 main">
    <notifications group="foo" />
    <div class="row">
      <div class="col-md-2 d-none d-md-block">
        <AdsComponent :ads="currentAds" />
      </div>
      <div class="col-md-8 col-12 offset-md-0 pt-0 pl-3 pr-3">
        <PostsComponent @setLocation="setLocation" :ads="currentAds" :typePosts="'posts'" />
      </div>
      <div class="col-md-2 d-none d-md-block">
        <NegociosComponent />
      </div>
    </div>
  </div>
</template>

<script>
import PostsComponent from "./PostsComponent.vue";
import AdsComponent from "./AdsComponent.vue";
import NegociosComponent from "./NegociosComponent.vue";

export default {
  components: {
    PostsComponent,
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
    //this.setLocation();
  },
  methods: {
    setLocation(lat, long) {
      //console.log("Seteando location");
      if (lat && long) {
        this.latitud = lat;
        this.longitud = long;
        this.url = "/api/ads/" + lat + "/" + long;
      }

      this.getAds();
    },
    getAds() {
      this.isLoading = true;
      //console.log("Loading ads");
      fetch(this.url)
        .then(response => response.json())
        .then(json => {
          this.ads = json.data;
          //console.log(json);
          this.currentAds = [...this.ads];
          //console.log("Cantidad de ads");
          //console.log(this.currentAds.length);
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