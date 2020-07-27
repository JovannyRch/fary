<template>
  <div class="mt-4 main">
    <notifications group="foo" />
    <div class="row">
      <div class="col-md-2 d-none d-md-block">
        <AdsComponent :ads="currentAds" />
      </div>
      <div class="col-md-8 col-10 offset-1 offset-md-0 pt-0 pl-3 pr-3">
        <div class="text-center">
          <div class="text-left">
            <a @click="$router.go(-1)" href="#" class="btn btn-outline-secondary mb-3">
              <i class="fas fa-arrow-left"></i> Regresar
            </a>
          </div>

          <div class="card">
            <div class="card-header">
              <h2>
                <i class="fas fa-question-circle"></i> Ayuda
              </h2>
            </div>
            <div class="card-body">
              <div class="text-justify">
                <div class="row">
                  <div class="col-md-3 col-12 text-center">
                    <img class="card-img-top w-75" src="/images/logo.jpg" alt />
                  </div>
                  <div class="col-md-9 col-12 p-4">
                    <p>
                      <b>¿Ocupa una refacción?</b> Si es así …
                    </p>
                    <p>
                      Haga una publicación de lo que necesita en refacciones usadas, la verán los
                      negocios de auto partes y quien tenga lo que necesita le responderá.
                    </p>
                    <p>Estas son unas sugerencias para una buena publicación</p>
                    <ul>
                      <li>
                        Indique la pieza que ocupa, la marca, submarca y modelo del vehículo, si es
                        nacional o extranjero
                      </li>
                      <li>
                        Características de la pieza o refacción si es derecha, izquierda, en ocasiones
                        puede ser el lugar donde se encuentra (debajo de, arriba de, a un costado
                        de), en algunos casos es igual a otros autos o camionetas si lo sabe,
                        coméntelo
                      </li>
                    </ul>
                    <i>Ejemplo</i>
                    <p>
                      Las publicaciones tienen 3 rangos de búsqueda 30 km para búsquedas
                      locales, 70 km el rango estándar de las publicaciones y abierto para buscar
                      piezas muy escasas en los estados más cercanos, sin recomendar comprarlas
                      por internet
                    </p>
                    <b>¿Es dueño de un negocio de auto partes usadas?</b>
                    <p>
                      Pertenecer a
                      <b>Auto Partes Usadas Fary</b> no tiene costo, solo basta registrar su
                      negocio por correo electrónico, mandar una foto de su negocio y mandar el
                      nombre y su e-mail, de cada uno de sus vendedores ya registrados en la
                      plataforma, para que se les autorice contestar las publicaciones de los
                      clientes
                    </p>
                    <p>
                      Correo electrónico para registrar su negocio
                      <a
                        href="mailto:faryseccionderegistros@gmail.com"
                      >faryseccionderegistros@gmail.com</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2 d-none d-md-block">
        <NegociosComponent />
      </div>
    </div>
  </div>
</template>

<script>
import AdsComponent from "./../AdsComponent.vue";
import NegociosComponent from "./../NegociosComponent.vue";

export default {
  components: {
    AdsComponent,
    NegociosComponent
  },
  data() {
    return {
      ads: [],
      currentAds: [],
      isLoading: false,
      latitud: null,
      longitud: null,
      url: "/api/ads"
    };
  },
  mounted() {
    this.getAds();
  },
  methods: {
    setLocation(lat, long) {
      console.log("Seteando location");
      if (lat && long) {
        this.latitud = lat;
        this.longitud = long;
        this.url = "/api/ads/" + lat + "/" + long;
      }

      this.getAds();
    },
    getAds() {
      this.isLoading = true;
      fetch(this.url)
        .then(response => response.json())
        .then(json => {
          this.ads = json.data;
          console.log(json);
          if (this.ads.length >= 3) {
            this.canUpdate = true;
            for (let i = 0; i <= 3; i++) {
              this.currentAds.push(this.ads.pop());
            }
          } else {
            while (this.ads.length > 0) {
              this.currentAds.push(this.ads.pop());
            }
          }
          this.isLoading = false;
        });
    },

    getRandom() {
      return this.ads[Math.floor(Math.random() * this.ads.length)];
    },
    shuffle(array) {
      array.sort(() => Math.random() - 0.5);
    }
  }
};
</script>

<style>
</style>