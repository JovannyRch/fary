<template>
  <div class="container" id="form-container">
    <h2 class="title-page">Crear un pedido</h2>
    <form
      action="/posts/save"
      @submit.prevent="addLocation"
      id="form-create"
      method="post"
      enctype="multipart/form-data"
    >
      <input type="hidden" name="_token" :value="csrf" />
      <div class="form-container">
        <div class="row">
          <div class="col-12 col-md-4">
            <div
              class="alert alert-warning text-justify"
            >Para un comentario de calidad escriba su pieza o refacción que busca, marca, submarca, si es nacional o extranjera y alguna descripción que complete la información</div>
          </div>
          <div class="col-md-8 col-12">
            <div class="row">
              <div :class="images.length? 'col-12 col-md-4 text-center':''">
                <img style="max-height: 200px" class="img-fluid" :src="images[0]" />
              </div>
              <div
                :class="images.length?'col-md-8 col-12 form-group':'col-12 col-md-12 form-group'"
              >
                <label for="content">
                  <b>Pieza o refacción</b>
                </label>
                <textarea
                  type="text"
                  name="content"
                  id="content"
                  class="form-control"
                  placeholder="Escribe aquí la pieza o refacción"
                  cols="30"
                  rows="3"
                ></textarea>
              </div>
              <div v-show="!images.length" class="form-group col-12">
                <label for="file">
                  <b>Foto o imagen</b>
                  <small id="fileHelpId" class="form-text text-muted">*Opcional</small>
                </label>
                <input
                  type="file"
                  class="form-control-file"
                  name="file"
                  id="file"
                  placeholder="Subir archivo"
                  aria-describedby="fileHelpId"
                  @change="onFileChange"
                />
              </div>

              <div :class="images.length?'col-md-8 offset-md-4':'col-12'">
                <button type="submit" class="btn btn-secondary text-white">Hacer publicación</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      content: "",
      img: "",
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content"),
      selectedFile: null,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      images: []
    };
  },
  methods: {
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      let i = 1;
      for (const img of files) {
        this.createImage(img);
        i++;
        if (i == 7) break;
      }
    },
    createImage(file) {
      var image = new Image();
      this.images = [];
      var vm = this;
      var reader = new FileReader();
      reader.onload = e => {
        vm.images.push(e.target.result);
      };
      reader.readAsDataURL(file);
    },
    async addLocation() {
      let result = await navigator.permissions.query({ name: "geolocation" });

      if (result.state === "granted" || result.state == "prompt") {
        navigator.geolocation.getCurrentPosition(location => {
          let lat = location.coords.latitude;
          let long = location.coords.longitude;
          this.insertLocation(lat, long);
          $("#form-create").submit();
        });
      } else {
        $("#form-create").submit();
      }
    },
    insertLocation(lat, long) {
      $("#form-create").append(
        `<input type="hidden"   name='latitud'  value=${lat} />`
      );
      $("#form-create").append(
        `<input type="hidden"  name='longitud'  value=${long} />`
      );
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