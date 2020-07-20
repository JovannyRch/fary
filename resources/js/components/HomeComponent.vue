<template>
  <div class="mt-4 main">
    <notifications group="foo" />
    <div class="row">
      <div class="col-md-2 d-none d-md-block">
        <AdsComponent :ads="currentAds1" @clickAd="clickAd" />
      </div>
      <div class="col-md-8 col-12 offset-md-0 pt-0 pl-3 pr-3">
        <pre>
          {{flag}}
          {{currentAds}}
        </pre>
        <PostsComponent
          @clickAd="clickAd"
          @setLocation="setLocation"
          :ads="currentAds"
          :typePosts="'posts'"
        />
      </div>
      <div class="col-md-2 d-none d-md-block">
        <AdsComponent :ads="currentAds2" @clickAd="clickAd2" />
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
      currentAds1: [],
      currentAds2: [],
      ads7s: [],
      ads10s: [],
      ads15s: [],
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
      },
      flag: true
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
    clickAd2(ad) {
      this.currentIndex = this.currentAds.length / 2 + ad;
      this.imageViewerFlag = true;
    },
    divideAds() {
      let n = this.currentAds.length;
      for (let i = 0; i < n; i++) {
        if (i < n / 2) {
          this.currentAds1.push(this.currentAds[i]);
        } else {
          this.currentAds2.push(this.currentAds[i]);
        }
      }
    },

    getAdsByTime() {
      for (let i in this.currentAds) {
        let ad = this.currentAds[i];
        if (ad.tiempo == 15) {
          this.ads15s.push(i);
        } else if (ad.tiempo == 10) {
          this.ads10s.push(i);
        } else if (ad.tiempo == 7) {
          this.ads7s.push(i);
        }
      }
    },

    getAds() {
      this.isLoading = true;

      fetch(this.url)
        .then(response => response.json())
        .then(json => {
          this.ads = json.data;

          this.currentAds = [...this.ads];
          this.divideAds();
          this.getAdsByTime();
          this.initAds();
          this.isLoading = false;
          this.imgUrlList = this.currentAds.map(a => a.url);
        });
    },

    getRandom() {
      return this.ads[Math.floor(Math.random() * this.ads.length)];
    },
    shuffle(array) {
      array.sort(() => Math.random() - 0.5);
    },
    changeAds(ads) {
      if (ads.length) {
        let aux = [...ads];
        aux = this.shuffle(aux);
        console.log(this.currentAds);
        for (let i in ads) {
          this.currentAds[ads[i]] = this.currentAds[aux[i]];
        }
        this.flag = !this.flag;
        console.log(this.currentAds);
      }
    },

    initAds() {
      setInterval(() => {
        this.changeAds(this.ads7s);
      }, 7000);
      setInterval(() => {
        this.changeAds(this.ads10s);
      }, 10000);
      setInterval(() => {
        this.changeAds(this.ads15s);
      }, 15000);
    },
    shuffle(a) {
      for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
      }
      return a;
    }
  }
};
</script>

<style>
</style>