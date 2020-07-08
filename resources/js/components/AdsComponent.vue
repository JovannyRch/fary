<template>
  <div>
    <div v-for="(ad,index) in ads" :key="index" class="text-center mt-4">
      <img class="img-thumbnail" :src="ad.url" v-if="!isVideo(ad.url)" />
      <video v-else autoplay :src="ad.url" width="100%" type="video/mp4"></video>
    </div>
  </div>
</template>

<script>
export default {
  props: ["ads"],
  data() {
    return {};
  },

  mounted() {
    //console.log(this.ads);
  },
  methods: {
    isVideo(src) {
      return src.endsWith("mp4");
    }
  }
};
</script>

<style>
</style>