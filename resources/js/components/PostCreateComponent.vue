<template>
  <div id="form-container">
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
          <div class="col-md-12 col-12">
            <div class="row">
              <div :class="images.length? 'col-3 text-center':''">
                <img style="max-height: 100px" class="img-fluid" :src="images[0]" />
              </div>
              <div :class="images.length? 'col-9 form-group':'col-12 col-md-12 form-group'">
                <input
                  v-model="content"
                  style="-webkit-border-radius: 50px;-moz-border-radius: 50px;border-radius: 50px;"
                  type="text"
                  name="content"
                  id="content"
                  class="form-control"
                  autocomplete="off"
                  required
                  placeholder="Escribe aquí la pieza o refacción"
                />
              </div>

              <div class="col-12">
                <input class="input-file" id="input-file" @change="onFileChange" type="file" name="file" multiple />
                <button type="submit" class="btn btn-sm btn-success float-right">Publicar</button>
                <button id="btn-file" type="button" class="float-right btn btn-success btn-sm mr-2">
                  <i class="fas fa-images"></i>
                </button>
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

  mounted() {
    $("#btn-file").on("click", function() {
      $("#input-file").trigger("click");
    });
  },
  watch: {
    content: function(val) {
      if (!this.user_id) {
        document.location.href = "/posts/create";
      }
    }
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
  padding-right: 40px;
  padding-left: 40px;
  padding-top: 10px;
  padding-bottom: 10px;
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

.fileinput-button {
  position: relative;
  overflow: hidden;
  display: inline-block;
}
</style>