<template>
  <div class="mt-4 main">
    <div class="row">
      <div class="col-md-2 d-none d-md-block" id="s-1">
        <AdsComponent :ads="currentAds" />
      </div>
      <div class="col-md-8 col-12" id="s-2">
        <PostsComponent :ads="currentAds" />
      </div>
      <div class="col-md-2 col-md-2 d-none d-md-block" id="s-3">
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
      isLoading: false
    };
  },
  created() {
    this.getAds();
  },
  methods: {
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
</style>