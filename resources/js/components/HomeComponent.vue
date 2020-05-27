<template>
  <div class="mt-4 main">
    <notifications group="foo" />
    <div class="row">
      <div class="col-md-2 d-none d-md-block">
        <!--  <AdsComponent :ads="currentAds" /> -->
      </div>
      <div class="col-md-8 col-10 offset-1 offset-md-0 pt-0 pl-3 pr-3">
        <PostsComponent
          @setLocation="setLocation(lat,long)"
          :ads="currentAds"
          :typePosts="'posts'"
        />
      </div>
      <div class="col-md-2 d-none d-md-block"></div>
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
    //this.getAds();
  },
  methods: {
    setLocation(lat, long) {
      if (lat != null && long != null) {
      } else {
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