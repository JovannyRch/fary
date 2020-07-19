<template>
  <div class="mt-4 main">
    <notifications group="foo" />
    <div class="row">
      <div class="col-md-2 d-none d-md-block">
        <AdsComponent :ads="currentAds" @clickAd="clickAd" />
      </div>
      <div class="col-md-8 col-12 offset-md-0 pt-0 pl-3 pr-3">
        <PostsComponent
          @clickAd="clickAd"
          @setLocation="setLocation"
          :ads="currentAds"
          :typePosts="'posts'"
        />
      </div>
      <div class="col-md-2 d-none d-md-block">
        <AdsComponent :ads="currentAds" @clickAd="clickAd" />
      </div>
    </div>
    <image-viewer-vue
      v-if="imageViewerFlag"
      @closeImageViewer="imageViewerFlag = false"
      @clickImage="clickImage"
      :imgUrlList="imgUrlList"
      :index="currentIndex"
      title="Publicidad"
      :closable="true"
      :cyclical="false"
      :alt="'Fotos'"
    ></image-viewer-vue>
  </div>
</template>

<script>
import PostsComponent from "./PostsComponent.vue";
import AdsComponent from "./AdsComponent.vue";
import NegociosComponent from "./NegociosComponent.vue";

import Flickity from "vue-flickity";

export default {
  components: {
    PostsComponent,
    AdsComponent,
    NegociosComponent,
    Flickity
  },
  data() {
    return {
      ads: [],
      currentAds: [],
      isLoading: false,
      latitud: null,
      longitud: null,
      url: "/api/ads",
      imageViewerFlag: false,
      currentIndex: 0,
      imgUrlList: [],
      flickityOptions: {
        initialIndex: 3,
        prevNextButtons: false,
        pageDots: false,
        wrapAround: false
      }
    };
  },
  mounted() {},
  methods: {
    setLocation(lat, long) {
      if (lat && long) {
        this.latitud = lat;
        this.longitud = long;
        this.url = "/api/ads/" + lat + "/" + long;
      }

      this.getAds();
    },
    clickAd(ad) {
      this.currentIndex = ad;
      this.imageViewerFlag = true;
    },
    getAds() {
      this.isLoading = true;

      fetch(this.url)
        .then(response => response.json())
        .then(json => {
          this.ads = json.data;
          //console.log(json);
          this.currentAds = [...this.ads];
          this.isLoading = false;
          this.imgUrlList = this.currentAds.map(a => a.url);
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