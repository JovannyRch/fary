<template>
  <div class="container">
    <div class="row">
      <div class="col-md-2 d-none d-md-block">
        <!--  <AdsComponent :ads="currentAds" /> -->
      </div>
      <div class="col-md-8 col-10 offset-1 offset-md-0 pt-0 pl-3 pr-3">
        <HeaderComponent class="mb-3" />
        <router-link to="/" class="btn btn-outline-secondary mb-3">
          <i class="fas fa-arrow-left"></i> Regresar
        </router-link>
        <PostComponent
          v-if="!loading"
          :content="post.content"
          :date="post.created_at"
          :user="post.user_id"
          :img="post.img"
          :imgs="post.imgs"
          :id="post.id"
          :username="post.username"
          :address="post.address"
          :post_user_id="post.user_id"
          :showName="true"
          :allComments="true"
          :typePosts="typePosts"
        />
        <div v-else class="w-100 text-center mt-5 pt-5">
          <LoaderComponent />
        </div>
      </div>
      <div class="col-md-2 d-none d-md-block"></div>
    </div>
  </div>
</template>


<script>
import PostComponent from "./PostComponent.vue";
import LoaderComponent from "./utils/LoaderComponent.vue";
import HeaderComponent from "./utils/HeaderComponent.vue";
export default {
  components: {
    PostComponent,
    LoaderComponent,
    HeaderComponent
  },
  data() {
    return {
      loading: true,
      id: this.$route.params.id,
      post: {
        content: null,
        date: null,
        user: null,
        img: null,
        imgs: [],
        username: null,
        address: null
      },
      typePosts: "cars",
      comments: []
    };
  },
  created: function() {
    this.getData();
  },
  methods: {
    getData() {
      this.loading = true;
      fetch("/api/cars/" + this.id)
        .then(response => response.json())
        .then(json => {
          let data = json.data;
          this.post = data;
          this.loading = false;
        });
    }
  }
};
</script>

<style>
</style>