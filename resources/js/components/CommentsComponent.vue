<template>
  <div style="padding-left: 3%; padding-right: 3%">
    <div v-if="comments.length">
      <div v-for="(c,index) in comments" :key="c.id">
        <div class="col-12" style="font-size:0.75em" v-if="(!showAll && index < 3) || (showAll)">
          <small>
            <router-link :to="'/user/'+c.user_id">
              <b style="color: grey">{{c.username}}</b>
            </router-link>
          </small>
          <DateComponent :date="c.date"></DateComponent>

          <div class="float-right pr-4 btn-sm">
            <span v-if="c.user_id == user_id">
              <i
                class="fa fa-trash"
                style="zomm: 0.7;color: grey"
                @click="deleteComment(c.id,index)"
              ></i>
            </span>
          </div>
        </div>
        <div class="p-0 comment" v-if="(!showAll && index < 3) || (showAll)">
          <div class="col-12 pl-3">
            <small style="color: grey">{{c.content}}</small>
          </div>
        </div>
      </div>
      <div v-if="!showAll && comments.length >= 4" class>
        <button
          class="btn btn-outline-success btn-sm redondo"
          @click="loadComments()"
        >Mostrar todos los comentarios</button>
      </div>
    </div>
    <div>
      <form
        @submit.prevent="sendComment()"
        v-if="user_id && (owner_post == user_id || type != 'normal')"
      >
        <div class="row ml-1">
          <div class="col-11 col-md-11">
            <div class="form-row text-center">
              <div class="form-group col-11">
                <input
                  type="text"
                  v-model="commentInput"
                  class="form-control redondo input-comment"
                  placeholder="Escribe aquí tu comentario"
                  aria-describedby="helpId"
                />
              </div>
              <div class="form-group col-1 col-md-1">
                <button
                  v-if="commentInput"
                  type="submit"
                  name
                  class="btn btn-success btn-sm redondo"
                >
                  <i class="fa fa-check"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import DateComponent from "./utils/DateComponent.vue";
export default {
  components: {
    DateComponent
  },
  props: ["post_id", "owner_post", "showName"],
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
          this.loadComments();
          this.commentInput = "";
        } else {
          alert("Ocurrió un erro al publicar el comentario");
        }
      });
    },
    deleteComment(comment_id, index) {
      fetch("/api/comments/" + comment_id, {
        method: "DELETE"
      }).then(response => {
        if (response.status == 200) {
          this.comments.splice(index, 1);
        } else {
          alert("Ocurrió un error al eliminar");
        }
      });
    }
  }
};
</script>

<style>
.comment {
  background-color: rgb(250, 250, 250);
  border: 0.5px solid rgb(218, 218, 218);
  margin-bottom: 5px;
  padding-top: 0.5%;
  padding-bottom: 0%;
  padding-left: 1.5%;
  padding-right: 1.5%;
  border-radius: 20px;
  margin-right: 2px;
  margin-left: 2px;
  width: 90%;
}

.input-comment {
  background-color: #f5f5f5;
  color: rgb(124, 124, 124);
  font-size: 0.8em;
  background-image: url("../../../public/images/resources/comment.png");
  background-position: 10px 10px;
  background-size: 20px;
  background-repeat: no-repeat;
  padding-left: 40px;
}
</style>