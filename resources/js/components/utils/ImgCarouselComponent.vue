<template>
  <div class="w-100">
    <div :id="'carousel-'+id" class="carousel slide" data-ride="carousel">
      <div v-show="img" class="w-100">
        <img @click="imageViewerFlag = true" class="w-100" :src="img" />
      </div>

      <div v-if="!img">
        <ol v-if="imgs.length > 1" class="carousel-indicators">
          <li
            data-target="#carouselExampleIndicators"
            :data-slide-to="index"
            :class="index == 0?'active':''"
            v-for="(img,index) in imgs"
            :key="index"
          ></li>
        </ol>
        <div class="carousel-inner">
          <div
            :class="index == 0?'carousel-item active text-center':'carousel-item text-center'"
            v-for="(img,index) in imgs"
            :key="index"
          >
            <img
              @click="imageViewerFlag = true"
              class="w-100 p-2"
              style="margin: 0 auto; boder: 1px solid black;max-height: 300px"
              :src="img.url"
              :alt="'imagen '+(index+1)"
            />
          </div>
        </div>
        <a
          v-if="imgs.length  > 1"
          @click="prev('carousel-'+id)"
          class="carousel-control-prev"
          href="#carouselExampleIndicators"
          role="button"
          data-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a
          @click="next('carousel-'+id)"
          v-if="imgs.length  > 1"
          class="carousel-control-next"
          href="#carouselExampleIndicators"
          role="button"
          data-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <image-viewer-vue
      v-if="imageViewerFlag"
      @closeImageViewer="imageViewerFlag = false"
      @clickImage="clickImage"
      :imgUrlList="imgUrlList"
      :index="currentIndex"
      :title="title"
      :closable="true"
      :cyclical="false"
      :alt="'Fotos'"
    ></image-viewer-vue>
  </div>
</template>

<script>
import Flickity from "vue-flickity";

export default {
  components: {
    Flickity
  },
  data() {
    return {
      imageViewerFlag: false,
      currentIndex: 0,
      imgUrlList: [],
      flickityOptions: {
        initialIndex: 3,
        prevNextButtons: false,
        pageDots: false,
        wrapAround: true
      }
    };
  },
  props: ["imgs", "id", "img", "title"],
  created() {
    this.imgUrlList = this.toArray();
  },
  mounted() {
    $(".carousel").carousel({
      interval: 3000
    });
  },
  methods: {
    next() {
      this.$refs.flickity.next();
    },

    previous() {
      this.$refs.flickity.previous();
    },
    clickImage() {
      console.log("Click a la imagen");
    },
    next(id) {
      $("#" + id).carousel("next");
    },
    prev(id) {
      $("#" + id).carousel("prev");
    },
    toArray() {
      let res = [];
      if (this.img) {
        res.push(this.img);
      } else {
        res = this.imgs.map(img => img.url);
      }
      return res;
    }
  }
};
</script>

<style>
.carousel-indicators .active {
  color: #3c7c64;
}

.carousel-control-prev-icon {
  background-color: #90b4a6;
}

.carousel-control-next-icon {
  background-color: #90b4a6;
}
</style>