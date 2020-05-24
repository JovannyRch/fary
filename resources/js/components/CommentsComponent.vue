<template>
  <div class="mt-2">
    <form
      @submit.prevent="sendComment()"
      v-if="user_id && (owner_post == user_id || type != 'normal')"
    >
      <div class="row ml-2">
        <div class="col-11 col-md-11">
          <div class="form-row text-center">
            <div class="form-group col-10">
              <input
                type="text"
                v-model="commentInput"
                class="form-control"
                placeholder="Escribe aquí tu comentario"
                aria-describedby="helpId"
              />
            </div>
            <div class="form-group col-1 col-md-1">
              <button type="submit" name id class="btn btn-secondary text-white">
                <i class="fa fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="mb-1" v-if="comments.length">
      <small>
        <b>Comentarios</b>
      </small>
    </div>
    <div v-if="comments.length">
      <div v-for="(c,index) in comments" :key="c.id">
        <div class="row comment" v-if="(!showAll && index < 3) || (showAll)">
          <div class="col-12">
            <small>
              <router-link :to="'/user/'+c.user_id">
                <b>{{c.username}}</b>
              </router-link>
            </small>

            <div class="float-right pr-4">
              <DateComponent :date="c.date"></DateComponent>
              <span v-if="c.user_id == user_id">
                <i class="fa fa-trash" style="zomm: 0.7" @click="deleteComment(c.id)"></i>
              </span>
            </div>
          </div>
          <div class="col-12 pl-3">
            <p>
              <small>{{c.content}}</small>
            </p>
          </div>
        </div>
      </div>
      <div v-if="!showAll && comments.length >= 4">
        <button
          class="btn btn-outline-info btn-small"
          @click="loadComments()"
        >Mostrar todos los comentarios</button>
      </div>
    </div>
  </div>
</template>

<script>
import DateComponent from "./utils/DateComponent.vue";
export default {
  components: {
    DateComponent
  },
  props: ["post_id", "owner_post"],
  created() {
    this.loadFirtsComments();
  },
  data() {
    return {
      comments: [],
      commentInput: "",
      showAll: false,
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content"),
      type: document.querySelector('meta[name="type"]').getAttribute("content")
    };
  },
  methods: {
    loadFirtsComments: function() {
      fetch(`/api/comments/post/${this.post_id}/firts`)
        .then(response => response.json())
        .then(json => {
          this.comments = json.data;
        });
    },
    loadComments: function() {
      this.showAll = true;
      fetch(`/api/comments/post/${this.post_id}`)
        .then(response => response.json())
        .then(json => {
          if (json.data.length > 0) {
            this.comments = json.data;
          }
        });
    },
    sendComment() {
      if (!this.commentInput) return;
      let data = {
        content: this.commentInput,
        post_id: this.post_id,
        user_id: this.user_id
      };
      fetch("/api/comments", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json"
        }
      }).then(async response => {
        if (response.status == 200) {
          let json = await response.json();
          this.comments = [...[json.data], ...this.comments];
          this.commentInput = "";
        } else {
          alert("Ocurrió un erro al publicar el comentario");
        }
      });
    },
    deleteComment(comment_id) {
      fetch("/api/comments/" + comment_id, {
        method: "DELETE"
      }).then(response => {
        if (response.status == 200) {
          this.loadComments();
        } else {
          alert("Ocurrió un error al eliminar");
        }
      });
    }
  }
};
</script>

<style>
.separator {
  height: 2px;
  background-color: bisque;
  width: 60%;
  margin: 0 auto;
}

.comment {
  background-color: rgb(243, 243, 242);
  margin-bottom: 15px;
  padding-top: 1.5%;
  padding-left: 1.5%;
  padding-right: 1.5%;
  border-radius: 10px;
  margin-right: 2px;
  margin-left: 2px;
  -webkit-box-shadow: 6px 9px 18px -11px rgba(191, 191, 191, 1);
  -moz-box-shadow: 6px 9px 18px -11px rgba(191, 191, 191, 1);
  box-shadow: 6px 9px 18px -11px rgba(191, 191, 191, 1);
}
</style>