<template>
  <div class="container">
    <h2>{{tipo.name}}</h2>

    <div class="card text-left mt-3" v-for="negocio in negocios" :key="negocio.id">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 col-12 p-2">
            <img class="w-100" :src="negocio.img" alt />
          </div>
          <div class="col-md-9 pl-3 col-12">
            <h4>
              <b>{{negocio.name}}</b>
            </h4>

            <div>
              <b>Dirección:</b>
              {{negocio.address}}
            </div>
            <div>
              <b>Teléfono:</b>
              {{negocio.phone}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: this.$route.params.id,
      tipo: {},
      negocios: []
    };
  },
  mounted() {
    this.loadData();
  },

  methods: {
    loadData() {
      fetch("/api/tipos/" + this.id)
        .then(response => response.json())
        .then(json => {
          this.tipo = json.data.tipo;
          this.negocios = json.data.negocios;
        });
    }
  }
};
</script>

<style>
</style>