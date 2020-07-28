<template>
  <div class="container">
    <div class="row">
      <div class="col-md-3 d-none d-md-block">
        <!--  <AdsComponent :ads="currentAds" /> -->
      </div>
      <div class="col-md-6 col-12 offset-md-0 pt-0">
        <HeaderComponent class="mb-3" v-if="user_id" />
        <router-link to="/" class="btn btn-outline-secondary mb-3">
          <i class="fas fa-arrow-left"></i> Regresar
        </router-link>
        <div v-if="!loading">
          <div v-if="!error">
            <PostComponent
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
          </div>
          <div v-else>Ocurrió un error</div>
        </div>
        <div v-else class="w-100 text-center mt-5 pt-5">
          <LoaderComponent />
        </div>
      </div>
      <div class="col-md-3 d-none d-md-block">
        <AdsComponent part="2" />
      </div>
    </div>
  </div>
</template>


<script>
import PostComponent from "./PostComponent.vue";
import LoaderComponent from "./utils/LoaderComponent.vue";
import HeaderComponent from "./utils/HeaderComponent.vue";
import AdsComponent from "./AdsComponent";
export default {
  components: {
    PostComponent,
    LoaderComponent,
    HeaderComponent,
    AdsComponent,
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
        address: null,
      },
      typePosts: "posts",
      comments: [],
      error: false,
      user_id: document.querySelector('meta[name="user_id"]')
        ? document.querySelector('meta[name="user_id"]').getAttribute("content")
        : null,
    };
  },
  created: function () {
    this.getData();
  },
  methods: {
    getData() {
      this.loading = true;
      fetch("/api/posts/" + this.id)
        .then((response) => response.json())
        .then((json) => {
          let data = json.data;
          this.post = data;
          this.loading = false;
        });
    },
  },
};
</script>

<style>
</style>