<template>
  <div class="container">
    <div class="row">
      <div class="col-md-2 d-none d-md-block">
        <AdsComponent part="1" />
      </div>
      <div class="col-md-8 col-12 offset-md-0 pt-0">
        <HeaderComponent class="mb-3" v-if="user_id" />
        <router-link to="/" class="btn btn-outline-secondary mb-3">
          <i class="fas fa-arrow-left"></i> Regresar
        </router-link>
        <PostComponent
          v-if="!loading && post.content != null"
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
      <div class="col-md-2 d-none d-md-block">
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
      typePosts: "cars",
      comments: [],
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
      fetch("/api/cars/" + this.id)
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