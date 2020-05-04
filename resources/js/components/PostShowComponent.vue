<template>
  <div class="container" id="main-container">
    <a type="button" class="btn btn-outline-secondary" href="javascript:history.go(-1)">
      <i class="fa fa-arrow-left"></i> Regresar
    </a>
    <div id="post-container">
      <div class="row">
        <div v-if="img" class="col-12 col-md-4">
          <img :src="img" class="img" :alt="piece" />
        </div>
        <div :class="img?'col-12 col-md-8': 'col-12'">
          <h2 class="title">{{piece}}</h2>
          <div>{{national == 1?'Nacional':'Extranjero'}}</div>
          <div>
            <b>Marca:</b>
            {{brand}}
          </div>
          <div>
            <b>Modelo:</b>
            {{model}}
          </div>
          <div>
            <p>
              <i>{{details}}</i>
            </p>
          </div>
          <div>{{formatDate(date)}}</div>
        </div>
        <div class="col-12 mt-3">
          <h6>Comentarios:</h6>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TimeAgo from "javascript-time-ago";
import es from "javascript-time-ago/locale/es";
TimeAgo.addLocale(es);
const timeAgo = new TimeAgo("es-MX");

export default {
  data() {
    return {
      id: this.$route.params.id,
      piece: "",
      model: "",
      brand: "",
      national: null,
      img: "",
      details: "",
      date: "",
      user_id: null,
      username: "",
      comments: []
    };
  },
  created: function() {
    this.getData();
  },
  methods: {
    getData() {
      fetch("/api/posts/" + this.id)
        .then(response => response.json())
        .then(json => {
          let data = json.data;
          this.piece = data.piece;
          this.model = data.model;
          this.brand = data.brand;
          this.national = data.national;
          this.img = data.img;
          this.details = data.details;
          this.date = data.created_at;
          this.username = data.username;
          this.user_id = data.user_id;
        });
    },
    formatDate(date) {
      let arrTime = date.split("T");
      let fecha = arrTime[0].split("-");
      let tiempo = arrTime[1].split(".")[0].split(":");
      let fechaJs = new Date(
        fecha[0],
        fecha[1] - 1,
        fecha[2],
        tiempo[0] - 5,
        tiempo[1],
        tiempo[2]
      );
      return timeAgo.format(fechaJs);
    }
  }
};
</script>

<style>
.img {
  width: 100%;
}

.title {
  color: #f3941a;
}
#main-container {
  min-height: 100vh;
}

.loader {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.loader {
  height: 100vh;
  display: -webkit-box;
  display: flex;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
}
</style>