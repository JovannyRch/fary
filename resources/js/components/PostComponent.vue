<template>
  <div class="post w-100 pb-3">
    <notifications group="foo" />
    <div class="post-data">
      <div class="row">
        <div
          :class="
                        img || imgs
                            ? 'col-12 col-md-8 pl-2 d-block d-md-none'
                            : 'col-12 col-md-12 pl-2 d-block d-md-none'
                    "
        >
          <div class="d-flex bd-highlight">
            <div class="p-2 w-100 bd-highlight">
              <span class="grid-1 content text-secondary">
                <i v-if="typePosts == 'posts'" class="fa fa-wrench"></i>
                <i v-else class="fas fa-car-side"></i>
                {{ content }}
              </span>
              <div class="col-12">
                <span class="post-user" v-if="showName">
                  <span style="color:grey">
                    <small>Publicado por:</small>
                  </span>
                  <small>{{ username }}</small>
                </span>
                <!-- <div>
                  <i>
                    <small style="color:grey">{{address}}</small>
                  </i>
                </div>-->
                <div>
                  <DateComponent :date="date" />
                </div>
                <div class="dropdown show float-right grid-2" v-if="post_user_id == user_id">
                  <a data-toggle="modal" data-target="#confirmDelete" style="color:grey">
                    <small>Eliminar publicación</small>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <hr />
        </div>
        <div v-if="img || imgs" class="col-12 col-md-4 p-2 pl-4 text-center">
          <ImgCarouselComponent :title="content" :imgs="imgs" :img="img" :id="id" />
        </div>
        <div
          :class="
                        img || imgs
                            ? 'col-12 col-md-8 pl-2 d-none d-md-block'
                            : 'col-12 col-md-12 pl-2 d-none d-md-block'
                    "
        >
          <div class="d-flex bd-highlight">
            <div class="p-2 w-100 bd-highlight">
              <span class="grid-1 content text-secondary">
                <i v-if="typePosts == 'posts'" class="fa fa-wrench"></i>
                <i v-else class="fas fa-car-side"></i>
                {{ content }}
              </span>
              <div class="col-12">
                <span class="post-user" v-if="post_user_id != user_id">
                  <span style="color:grey">
                    <small>Publicado por:</small>
                  </span>
                  <small>{{ username }}</small>
                </span>
                <span v-if="post_user_id == user_id" class="post-user">
                  <small style="color:grey">
                    <i>Tu publicación</i>
                  </small>
                  <br />
                  <span style="color:grey">
                    <small>Publicado por:</small>
                  </span>
                  <small>{{ username }}</small>
                </span>
                <!-- <div>
                  <i>
                    <small style="color:grey">{{address}}</small>
                  </i>
                </div>-->
                <div>
                  <DateComponent :date="date" />
                </div>
                <div class="dropdown show float-right grid-2" v-if="post_user_id == user_id">
                  <a
                    data-toggle="modal"
                    data-target="#confirmDelete"
                    @click="setDeleteId(id)"
                    style="color:grey"
                  >
                    <small>Eliminar publicación {{id}}</small>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <hr />
        </div>
        <div class="col-12 pl-2 pt-0">
          <CommentsComponent
            :canComment="canComment"
            :showName="showName"
            :owner_post="post_user_id"
            :post_id="id"
            :typePosts="typePosts"
            :showAll="allComments"
          ></CommentsComponent>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="show-img"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ content }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="w-100 text-center">
              <img id="img-post" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="confirmDelete"
      tabindex="-1"
      role="dialog"
      aria-labelledby="confirmDeleteLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteLabel">
              <b>Advertencia</b>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">¿Estás seguro de eliminar la publicación?</div>

          <div class="modal-footer">
            <button type="button" @click="deletePost()" class="btn btn-outline-danger">Eliminar</button>
            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DateComponent from "./utils/DateComponent.vue";
import CommentsComponent from "./CommentsComponent.vue";
import ImgCarouselComponent from "./utils/ImgCarouselComponent.vue";

export default {
  components: {
    DateComponent,
    CommentsComponent,
    ImgCarouselComponent
  },
  props: [
    "content",
    "date",
    "user",
    "img",
    "id",
    "post_user_id",
    "username",
    "address",
    "imgs",
    "typePosts",
    "allComments",
    "deleteUrl"
  ],
  computed: {
    deleteId() {
      return this.$store.getters.deleteId;
    }
  },
  data() {
    return {
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content"),
      type: document.querySelector('meta[name="type"]')
        ? document.querySelector('meta[name="type"]').getAttribute("content")
        : null,
      auxContent: null,
      auxImg: null,
      canComment: false,
      dialog: false,
      showName: true
    };
  },
  created() {
    if (this.user_id) {
      if (this.type == "owner") {
        this.canComment = true;
      } else {
        if (this.typePosts == "posts") {
          this.canComment = this.user_id == this.post_user_id;
        } else {
          this.canComment = true;
        }
      }
    } else {
      this.canComment = false;
    }
  },
  mounted() {
    $(".dropdown-toggle").dropdown();
    $("#show-img").on("show.bs.modal", function(event) {
      var button = $(event.relatedTarget);
      var img = button.data("img");
      var content = button.data("post");

      var modal = $(this);
      modal.find(".modal-title").text(content);
      modal.find("img").attr("src", img);
    });
  },
  methods: {
    setDeleteId(id) {
      this.$store.dispatch("setAction", id);
    },
    showPost() {
      $("#img-post").attr("src", this.img);
      $("#show-img").modal("show");
    },
    isValidateImg(img) {},
    deletePost() {
      let url = `api/${this.typePosts}/` + this.deleteId;

      fetch(url, {
        method: "delete"
      }).then(response => {
        if (response.status == 200) {
          //Éxito al eliminar el post
          this.$emit("updateData", "");
          Vue.notify({
            group: "foo",
            title: "Aviso",
            text: "Se ha eliminado la publicación con éxito",
            type: "success"
          });
        } else {
          //Error al eliminar el post
        }
        $("#confirmDelete").modal("hide");
      });
    }
  }
};
</script>

<style>
.post-data {
  font-size: 1.2em;
}

.separator {
  margin: 0;
  height: 1px;
  border-radius: 10px;
  background-color: gainsboro;
}
.content {
  color: rgb(94, 94, 94);
}

.post {
  padding-top: 0%;
  padding-left: 2%;
  padding-right: 2%;
  background-color: white;
  border-radius: 10px;
  margin-bottom: 3%;
  -webkit-box-shadow: 1px 9px 18px -11px rgba(191, 191, 191, 1);
  -moz-box-shadow: 1px 9px 18px -11px rgba(191, 191, 191, 1);
  box-shadow: 1px 9px 18px -11px rgba(191, 191, 191, 1);
}
.post-detail {
  color: #a7a7a7;
}

.post-info {
  margin-top: 1%;
  margin-bottom: 1%;
  padding: 1%;
}

.topics-container {
  margin-top: 1%;
  margin-bottom: 1%;
  padding: 1%;
}

.topic {
  background-color: #e7f3ff;
  margin-right: 4px;
  color: #427fc2;
  font-size: 0.7em;
  padding: 2%;
  padding-bottom: 0.7%;
  padding-top: 0.7%;
  border-radius: 5px;
  font-weight: 600;
}

.grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  grid-template-rows: 1fr;
  grid-column-gap: 0px;
  grid-row-gap: 0px;
}

.grid-1 {
  grid-area: 1 / 1 / 2 / 4;
}
.grid-2 {
  grid-area: 1 / 4 / 2 / 6;
}

.details {
  width: 100%;
}

.details p {
  width: 100%;
}

.main-row {
  width: inherit;
}
</style>
