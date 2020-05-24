<template>
  <div :id="'carousel-'+id" class="carousel slide" data-ride="carousel">
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
</template>

<script>
export default {
  props: ["imgs", "id"],
  mounted() {
    $(".carousel").carousel({
      interval: 3000
    });
  },
  methods: {
    next(id) {
      $("#" + id).carousel("next");
    },
    prev(id) {
      $("#" + id).carousel("prev");
    }
  }
};
</script>

<style>
.carousel-indicators .active {
  color: #3c7c64;
}

.carousel-indicators {
}
.carousel-control-prev-icon {
  background-color: #90b4a6;
}

.carousel-control-next-icon {
  background-color: #90b4a6;
}
</style>