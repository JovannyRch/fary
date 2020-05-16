<template>
  <div class="container" id="form-container">
    <h2 class="title-page">Crear una publicación de auto chocado</h2>
    <form
      @submi.prevent="addLocation"
      id="form-create"
      action="/cars/save"
      method="post"
      enctype="multipart/form-data"
    >
      <div class="form-container">
        <div class="row">
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="user_id" :value="user_id" />

          <div class="col-12 form-group">
            <label for="content">
              <b>Contenido</b>
            </label>
            <input
              type="text"
              name="content"
              id="content"
              class="form-control"
              required
              placeholder="Escribe aquí la información sobre el auto"
            />
          </div>
          <b>Fotos o imágenes</b>
          <small id="helpId" class="text-muted ml-2">* Máximo 6 archivos</small>

          <div v-show="!images.length" class="col-12">
            <br />
            <input required type="file" name="imgs[]" multiple @change="onFileChange" />
          </div>
          <div v-show="images.length">
            <div class="row">
              <div v-for="(img,index) in images" :key="index" :class="'col-4 p-3 col-md-'+calc">
                <button
                  type="button"
                  class="btn btn-outline-light text-dark"
                  @click="removeImage(index)"
                >Quitar</button>
                <br />
                <br />

                <img style="max-height: 300px" class="img-fluid" :src="img" />
              </div>
            </div>
          </div>
          <div class="col-12 mt-2">
            <button type="submit" class="btn btn-secondary text-white">Hacer publicación</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  created() {},
  data() {
    return {
      content: "",
      images: [],
      piece: "",
      model: "",
      brand: "",
      national: 1,
      img: "",
      details: "",
      imgs: [1],
      lat: null,
      long: null,
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content"),
      selectedFile: null,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      let i = 1;
      for (const img of files) {
        console.log("Agregar esto:");

        this.createImage(img);
        i++;
        if (i == 7) break;
      }
    },
    createImage(file) {
      var image = new Image();

      var vm = this;
      var reader = new FileReader();
      reader.onload = e => {
        vm.images.push(e.target.result);
      };
      reader.readAsDataURL(file);
    },
    removeImage: function(index) {
      this.images.splice(index, 1);
    },
    addLocation() {
      navigator.geolocation.getCurrentPosition(function(location) {
        let lat = location.coords.latitude;
        let long = location.coords.longitude;
        alert(lat);
        alert(long);
        $("<input />")
          .attr("type", "hidden")
          .attr("name", "latitud")
          .attr("value", lat)
          .appendTo("#form");
        $("<input />")
          .attr("type", "hidden")
          .attr("name", "logitud")
          .attr("value", long)
          .appendTo("#form");
        $("#form-create").submit();
      });
    }
  },
  computed: {
    calc() {
      let val = Math.floor(12 / this.images.length);
      console.log(val);
      return val;
    }
  }
};
</script>

<style>
.form-container {
  background-color: white;
  border-radius: 5px;
  padding: 50px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 2px 6px rgba(0, 0, 0, 0.06),
    0 3px 8px rgba(0, 0, 0, 0.09);
}
.title-page {
  font-weight: bold;
  margin-bottom: 1%;
  margin-top: 1.5%;
}
.col-12 {
  padding: 0;
}
.col-md-12 {
  padding: 0;
}

.col-md-4 {
  padding: 0;
  padding-right: 3%;
}

#form-container {
  min-height: 100vh;
}
</style>