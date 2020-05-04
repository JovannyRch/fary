<template>
  <div>
    <ul class="list-group">
      <li class="list-group-item">
        <router-link to="/vision">Visión</router-link>
      </li>
      <li class="list-group-item">
        <router-link to="/mision">Misión</router-link>
        <span class="badge badge-dark float-right"></span>
      </li>

      <li class="list-group-item">
        <router-link to="/aviso-privacidad">Aviso de privacidad</router-link>
        <span class="badge badge-dark float-right"></span>
      </li>
      <li class="list-group-item">
        <router-link to="/ayuda">Ayuda</router-link>
        <span class="badge badge-dark float-right"></span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  mounted() {},
  data() {
    return {};
  },
  methods: {}
};
</script>

<style>
</style>