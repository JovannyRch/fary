<template>
    <div class="mt-4 main">
        <notifications group="foo" />
        <div class="row">
            <div class="col-md-2 d-none d-md-block">
                <AdsComponent part="1" @clickAd="clickAd" />
            </div>
            <div class="col-md-8 col-12 offset-md-0 pt-0 pl-3 pr-3">
                <button @click="incrementCounter">increment counter</button>
                <PostsComponent
                    @clickAd="clickAd"
                    @setLocation="setLocation"
                    :typePosts="'posts'"
                />
            </div>
            <div class="col-md-2 d-none d-md-block">
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
    mounted() {
        if (this.ads.length == 0) {
            //Cargar ads
        }
    },
    computed: {
        ads() {
            return this.$store.getters.ads;
        }
    },
    methods: {
        incrementCounter() {
            this.$store.dispatch("inrementAction", 1);
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
                    this.currentAds = [...json.data];
                    this.$store.dispatch("updateAction", this.currentAds);
                    this.divideAds();
                    this.getAdsByTime();
                    this.initAds();
                    this.isLoading = false;
                    this.imgUrlList = this.currentAds.map(a => a.url);
                });
        },

        getRandom() {
            return this.currentAds[
                Math.floor(Math.random() * this.currentAds.length)
            ];
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
        shuffle(b) {
            let a = [...b];
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        }
    }
};
</script>

<style></style>
