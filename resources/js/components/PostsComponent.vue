<template>
  <div class="container" id="container-post">
    <div class="row">
      <div class="col-md-8 col-12">
        <h1 class="title-page">Autopartes</h1>
      </div>
      <div class="col-md-4 col-12 float-right">
        <a class="btn btn-secondary text-white" href="/posts/create">
          <i class="fa fa-plus"></i>
          Hacer una publicación
        </a>
      </div>

      <div class="col-md-12">
        <div class="posts-container" v-if="!isLoading">
          <br />

          <PostComponent
            v-for="(p,index) in posts"
            :piece="p.piece"
            :date="p.created_at"
            :user="p.user_id"
            :model="p.model"
            :brand="p.brand"
            :national="p.national"
            :details="p.details"
            :img="p.img"
            :id="p.id"
            :username="p.username"
            :post_user_id="p.user_id"
            :key="p.id"
            @updateData="deletePost(index)"
          />
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
      path: ""
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
</style>