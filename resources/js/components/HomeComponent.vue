<template>
  <div class="mt-4 main">
    <div class="row">
      <div class="col-md-2" id="s-1">
        <AdsComponent />
      </div>
      <div class="col-md-8" id="s-2">
        <PostsComponent />
      </div>
      <div class="col-md-2" id="s-3">
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
  }
};
</script>

<style>
</style>