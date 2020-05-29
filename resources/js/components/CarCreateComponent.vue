<template>
  <div id="form-container">
    <form
      @submit.prevent="addLocation"
      id="form-create"
      action="/cars/save"
      method="post"
      enctype="multipart/form-data"
    >
      <input type="hidden" name="_token" :value="csrf" />
      <input type="hidden" name="user_id" :value="user_id" />
      <div class="form-container">
        <div class="row">
          <div class="col-md-12 col-12">
            <div class="row">
              <div class="col-12 form-group">
                <input
                  v-model="content"
                  style="-webkit-border-radius: 50px;-moz-border-radius: 50px;border-radius: 50px;"
                  type="text"
                  name="content"
                  id="content"
                  class="form-control"
                  autocomplete="off"
                  placeholder="Escribe aquí la información sobre el auto "
                />
              </div>
              <div class="col-12">
                <img
                  style="width: 80px"
                  class="mr-2"
                  width="50px"
                  v-for="(img,index) in images"
                  :src="img"
                  :key="index"
                />
              </div>

              <div class="col-12" v-show="content">
                <input
                  id="input-file"
                  accept="image/*"
                  @change="onFileChange"
                  type="file"
                  name="imgs[]"
                  multiple
                />
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
  created() {},
  mounted() {
    $("#btn-file").on("click", function() {
      $("#input-file").trigger("click");
    });
    $("#input-file").change(() => {
      this.files = [...this.files, ...$("#input-file")[0].files];
      $("#input-file")[0].files = this.FileListItem(this.files);
    });
  },
  data() {
    return {
      content: "",
      files: [],
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
  watch: {
    content: function(val) {
      if (!this.user_id) {
        document.location.href = "/cars/create";
      }
    }
  },
  methods: {
    FileListItem(a) {
      a = [].slice.call(Array.isArray(a) ? a : arguments);
      for (var c, b = (c = a.length), d = !0; b-- && d; )
        d = a[b] instanceof File;
      if (!d)
        throw new TypeError(
          "expected argument to FileList is File or array of File objects"
        );
      for (
        b = new ClipboardEvent("").clipboardData || new DataTransfer();
        c--;

      )
        b.items.add(a[c]);
      return b.files;
    },
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
    async addLocation() {
      if (!this.images.length) {
        Vue.notify({
          group: "foo",
          title: "Aviso",
          text: "Debe enviar al menos una foto del auto",
          type: "warn"
        });
        return;
      } else {
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
  },
  computed: {
    calc() {
      let val = Math.floor(12 / this.images.length);

      return val;
    }
  }
};
</script>

<style>
</style>