<template>
  <div>
    <div v-for="(ad,index) in currentAds" :key="index" class="text-center mt-4">
      <img class="img-thumbnail" :src="ad.url" v-if="!isVideo(ad.url)" />
      <video v-else autoplay :src="ad.url" width="100%" type="video/mp4"></video>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ads: [],
      currentAds: [],
      isLoading: false,
      canUpdate: false
    };
  },

  mounted() {
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

    isVideo(src) {
      console.log(src);
      return src.endsWith("mp4");
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