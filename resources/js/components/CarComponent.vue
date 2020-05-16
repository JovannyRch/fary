<template>
  <div class="post">
    <div class="post-data">
      <div class="row">
        <div class="col-12 pl-2">
          <span class="post-user">
            <router-link :to="'/users/'+user_id">
              <small>
                <b>{{username}}</b>
              </small>
            </router-link>
          </span>
          <DateComponent class="float-right" :date="date" />
          <hr />
        </div>

        <div class="col-12 col-md-12 pl-2">
          <div class="d-flex bd-highlight">
            <div class="p-2 w-100 bd-highlight">
              <b class="text-secondary grid-1">{{content}}</b>
            </div>
            <div class="p-2 flex-shrink-1 bd-highlight">
              <div class="dropdown show float-right grid-2" v-if="post_user_id == user_id">
                <a
                  class="btn btn-dark dropdown-toggle text-white"
                  href="#"
                  role="button"
                  id="dropdownMenuLink"
                  data-toggle="dropdown"
                  aria-haspopup="false"
                  aria-expanded="false"
                >Opciones</a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" data-toggle="modal" data-target="#confirmDelete">Eliminar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12" v-if="imgs.length">
          <ImgCarouselComponent :imgs="imgs" :id="id" />
        </div>
        <div class="col-12 pl-2">
          <CommentCarsComponent :car_post_id="id" />
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
import CommentCarsComponent from "./CommentCarsComponent.vue";
import ImgCarouselComponent from "./utils/ImgCarouselComponent.vue";

export default {
  components: {
    DateComponent,
    CommentCarsComponent,
    ImgCarouselComponent
  },
  props: ["content", "id", "post_user_id", "username", "date", "imgs"],
  data() {
    return {
      img: null,
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content")
    };
  },
  methods: {
    isValidateImg(img) {},
    deletePost() {
      fetch("/api/cars/" + this.id, {
        method: "delete"
      }).then(response => {
        if (response.status == 200) {
          //Éxito al eliminar el post
          alert("Eliminado correctamente");
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

.post-detail {
  color: #a7a7a7;
}

.post-user {
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