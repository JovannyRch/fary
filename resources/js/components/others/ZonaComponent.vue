<template>
  <div class="mt-4 main">
    <notifications group="foo" />
    <div class="row">
      <div class="col-md-3 d-none d-md-block">
        <AdsComponent part="1" @clickAd="clickAd" />
      </div>
      <div class="col-md-6 col-12 offset-md-0 pt-0">
        <div class="container mt-3">
          <ul class="list-group">
            <li class="list-group-item" v-for="tipo in tipos" :key="tipo.id">
              <router-link :to="'/zona-publicitaria/'+tipo.id">{{tipo.name}}</router-link>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-3 d-none d-md-block">
        <AdsComponent part="2" @clickAd="clickAd2" />
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
import AdsComponent from "./../AdsComponent.vue";
import NegociosComponent from "./../NegociosComponent";

export default {
  components: {
    AdsComponent,
    NegociosComponent,
  },
  data() {
    return {
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
        wrapAround: false,
      },
      interval1: null,
      interval2: null,
      interval3: null,
      tipos: [],
    };
  },
  mounted() {
    if (this.ads.length) {
      this.getAdsByTime();
      this.initAds();
    } else {
      this.getAds();
    }
    this.getData();
  },
  computed: {
    ads() {
      return this.$store.getters.ads;
    },
  },
  destroyed() {
    clearInterval(this.interval1);
    clearInterval(this.interval2);
    clearInterval(this.interval3);
  },
  methods: {
    getData() {
      fetch("/api/tipos")
        .then((response) => response.json())
        .then((json) => {
          this.tipos = json.data;
        });
    },
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
      this.currentIndex = this.ads.length / 2 + ad;
      this.imageViewerFlag = true;
    },

    getAdsByTime() {
      for (let i in this.ads) {
        let ad = this.ads[i];
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

      if (!this.ads.length) {
        fetch(this.url)
          .then((response) => response.json())
          .then((json) => {
            this.$store.dispatch("updateAction", [...json.data]);
            this.getAdsByTime();
            this.initAds();
            this.isLoading = false;
          });
      } else {
        this.getAdsByTime();
        this.initAds();
        this.isLoading = false;
      }
    },
    shuffle(array) {
      array.sort(() => Math.random() - 0.5);
    },
    changeAds(ads) {
      if (ads.length) {
        let auxState = [...this.ads];
        let newIndexes = this.shuffle(ads);
        for (let i = 0; i < ads.length; i++) {
          auxState[newIndexes[i]] = this.ads[ads[i]];
        }
        this.$store.dispatch("updateAction", auxState);
      }
    },

    initAds() {
      clearInterval(this.interval1);
      clearInterval(this.interval2);
      clearInterval(this.interval3);
      this.interval1 = setInterval(() => {
        this.changeAds(this.ads7s);
      }, 7000);
      this.interval2 = setInterval(() => {
        this.changeAds(this.ads10s);
      }, 10000);
      this.interval3 = setInterval(() => {
        this.changeAds(this.ads15s);
      }, 15000);
    },
    shuffle(b) {
      let a = [...b];
      for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
      }
      return a;
    },
  },
};
</script>



