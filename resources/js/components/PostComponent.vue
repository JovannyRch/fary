<template>
  <div class="post w-100">
    <div class="post-data">
      <div class="row">
        <div v-if="img" class="col-12 col-md-4 p-2 text-center">
          <img :src="img" height="180px" />

          <div class="text-center">
            <button
              type="button"
              class="btn btn-light btn-sm"
              data-toggle="modal"
              data-target="#show-img"
              :data-img="img"
              :data-post="content"
            >
              <i class="fa fa-eye"></i>
            </button>
          </div>
        </div>

        <div :class="img? 'col-12 col-md-8 pl-2': 'col-12 col-md-12 pl-2'">
          <div class="d-flex bd-highlight">
            <div class="p-2 w-100 bd-highlight">
              <div class="col-12">
                <span class="post-user">
                  <router-link :to="'/users/'+user_id">
                    <small>
                      <b>{{username}}</b>
                    </small>
                  </router-link>
                </span>
                <div class="float-right">
                  <DateComponent :date="date" />
                </div>
                <hr />
              </div>
              <b class="text-secondary grid-1">{{content}}</b>
            </div>
            <div class="p-2 flex-shrink-1 bd-highlight">
              <div class="dropdown show float-right grid-2" v-if="post_user_id == user_id">
                <a
                  class="btn btn-outline-light text-dark dropdown-toggle text-white"
                  href="#"
                  role="button"
                  id="dropdownMenuLink"
                  data-toggle="dropdown"
                  aria-haspopup="false"
                  aria-expanded="false"
                >
                  <i class="fas fa-ellipsis-h"></i>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" data-toggle="modal" data-target="#confirmDelete">Eliminar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 pl-2">
          <CommentsComponent :owner_post="post_user_id" :post_id="id"></CommentsComponent>
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

    <!-- Modal -->
    <div
      class="modal fade"
      id="show-img"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="w-100 text-center">
              <img src alt width="100%" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DateComponent from "./utils/DateComponent.vue";
import CommentsComponent from "./CommentsComponent.vue";

export default {
  components: {
    DateComponent,
    CommentsComponent
  },
  props: ["content", "date", "user", "img", "id", "post_user_id", "username"],
  data() {
    return {
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content")
    };
  },
  mounted() {
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
    isValidateImg(img) {},
    deletePost() {
      fetch("/api/posts/" + this.id, {
        method: "delete"
      }).then(response => {
        if (response.status == 200) {
          //Éxito al eliminar el post
          this.$emit("updateData", "");
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
  height: 1px;
  border-radius: 10px;
  background-color: gainsboro;
}

.post {
  padding: 3%;
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