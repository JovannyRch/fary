<template>
  <div class="mt-2">
    <form @submit.prevent="sendComment()" v-if="user_id ">
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
    <div class="mt-1 mb-1" v-if="comments.length">
      <small style="color: grey">Comentarios</small>
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
  props: ["car_post_id"],
  created() {
    this.loadFirtsComments();
  },
  data() {
    return {
      comments: [],
      showAll: false,
      commentInput: "",
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content"),
      type: document.querySelector('meta[name="type"]').getAttribute("content")
    };
  },
  methods: {
    loadFirtsComments: function() {
      fetch(`/api/car/${this.car_post_id}/comments/firts`)
        .then(response => response.json())
        .then(json => {
          this.comments = json.data;
        });
    },
    loadComments: function() {
      this.showAll = true;
      fetch(`/api/car/${this.car_post_id}/comments/`)
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
        car_post_id: this.car_post_id,
        user_id: this.user_id
      };
      fetch("/api/car/comments", {
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
      fetch("/api/car/comments/" + comment_id, {
        method: "DELETE"
      }).then(response => {
        if (response.status == 200) {
          if (this.showAll) {
            this.loadComments();
          } else {
            this.loadFirtsComments();
          }
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
</style>