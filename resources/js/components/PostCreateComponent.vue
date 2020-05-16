<template>
  <div class="container" id="form-container">
    <h2 class="title-page">Crear un pedido</h2>
    <form action="/posts/save" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" :value="csrf" />
      <div class="form-container">
        <div class="row">
          <div class="col-12 col-md-4">
            <div
              class="alert alert-warning text-justify"
            >Realiza tu anuncio detallando la marca, submarca, modelo, si es vehículo nacional o extranjero, factura original o refacturado y especifica la situación en la que se encuentre.</div>
          </div>
          <div class="col-md-8 col-12">
            <div class="col-12 form-group">
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
                rows="5"
              ></textarea>
            </div>

            <div class="form-group col-12">
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
              />
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-secondary text-white">Hacer publicación</button>
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