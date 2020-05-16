<template>
  <div class="container" id="container-post">
    <div class="row">
      <div class="col-md-8 col-12">
        <h1 class="title-page">Autopartes</h1>
      </div>
      <div class="col-md-4 col-12">
        <a v-if="!user_id" class="btn btn-success text-white float-right" href="/posts/create">
          <i class="fa fa-plus"></i>
          Crear una publicación
        </a>

        <router-link v-else to="/posts/create" class="btn btn-success text-white float-right">
          <i class="fa fa-plus"></i>
          Crear una publicación
        </router-link>
      </div>

      <div class="col-md-12">
        <div class="posts-container" v-if="!isLoading">
          <br />

          <div style="background-color: transparent" v-for="(p,index) in posts" :key="p.id">
            <img
              :src="ads[(index-2)/2].url"
              width="100%"
              v-if=" (index -2) >= 0 &&(index-2)% 2==0 && (index-2)/2 < ads.length  "
              class="d-block d-md-none text-center mb-3"
            />

            <PostComponent
              :content="p.content"
              :date="p.created_at"
              :user="p.user_id"
              :img="p.img"
              :id="p.id"
              :username="p.username"
              :post_user_id="p.user_id"
              @updateData="deletePost(index)"
            />
          </div>
        </div>
        <div v-else>
          <LoaderComponent></LoaderComponent>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import PostComponent from "./PostComponent.vue";
import LoaderComponent from "./utils/LoaderComponent.vue";

export default {
  props: ["ads"],
  components: {
    PostComponent,
    LoaderComponent
  },
  mounted() {
    this.loadData();
  },
  data() {
    return {
      isLoading: true,
      posts: [],
      currentPage: 1,
      firtsPageUrl: "",
      lastPageUrl: "",
      nextPageUrl: "",
      prevPageUrl: "",
      lastPage: 1,
      total: 1,
      path: "",
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content")
    };
  },
  methods: {
    loadData: function(url = `/api/posts`) {
      this.isLoading = true;
      fetch(url)
        .then(response => response.json())
        .then(json => {
          let data = json.data;
          this.posts = data.data;
          this.currentPage = data.current_page;
          this.firtsPageUrl = data.first_page_url;
          this.lastPage = data.last_page;
          this.nextPageUrl = data.next_page_url;
          this.prevPageUrl = data.prev_page_url;
          this.isLoading = false;
          this.total = Math.ceil(data.total / data.per_page);
          this.path = data.path;
        });
    },

    deletePost(index) {
      this.posts.splice(index, 1);
    }
  }
};
</script>

<style>
#container-post {
  height: 80vh;
  margin-bottom: 10%;
  overflow-y: scroll;
}

.title-page {
  font-weight: bold;
  margin-bottom: 1%;
  margin-top: 1.5%;
}

.container-tools {
  height: 30px;
}

.ad {
  background-color: transparent;
}
</style>