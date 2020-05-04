<template>
  <div class="container" id="form-container">
    <h2 class="title-page">Crear un pedido</h2>
    <form action="/posts/save" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" :value="csrf" />
      <div class="form-container">
        <div class="row">
          <div class="col-12 form-group">
            <label for="piece">
              <b>Pieza o refacción</b>
            </label>
            <input
              type="text"
              name="piece"
              id="piece"
              class="form-control"
              placeholder="Escribe aquí la pieza o refacción"
            />
          </div>
          <div class="col-12 col-md-4 form-group">
            <label for="brand">
              <b>Marca</b>
            </label>
            <input
              type="text"
              name="brand"
              id="brand"
              class="form-control"
              placeholder="Escribe aquí la marca"
            />
          </div>
          <div class="col-12 col-md-4 form-group">
            <label for="model">
              <b>Modelo</b>
            </label>
            <input
              v-model="model"
              type="text"
              name="model"
              id="model"
              class="form-control"
              placeholder="Escriba aquí el modelo"
            />
          </div>
          <div class="col-12 col-md-4">
            <div class="form-check">
              <label class="form-check-label">
                <input
                  type="radio"
                  class="form-check-input"
                  name="national"
                  id="1"
                  value="1"
                  checked
                />
                Nacional
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input
                  type="radio"
                  class="form-check-input"
                  name="national"
                  id="nacional"
                  value="0"
                />
                Extranjero
              </label>
            </div>
          </div>

          <div class="col-12 form-group">
            <label for="details">
              <b>Especificaciones</b>
            </label>
            <textarea class="form-control" name="details" id="details" rows="3"></textarea>
          </div>

          <div class="form-group col-12">
            <label for="file">
              <b>Foto o imagen</b>
            </label>
            <input
              type="file"
              class="form-control-file"
              name="file"
              id="file"
              placeholder="Subir archivo"
              aria-describedby="fileHelpId"
            />
            <small id="fileHelpId" class="form-text text-muted">*Opcional</small>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-secondary text-white">Hacer publicación</button>
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
      piece: "",
      model: "",
      brand: "",
      national: 1,
      img: "",
      details: "",
      user_id: document
        .querySelector('meta[name="user_id"]')
        .getAttribute("content"),
      selectedFile: null,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {}
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