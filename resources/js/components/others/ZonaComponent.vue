<template>
  <div class="container mt-3">
    <ul class="list-group">
      <li class="list-group-item" v-for="tipo in tipos" :key="tipo.id">
        <router-link :to="'/zona-publicitaria/'+tipo.id">{{tipo.name}}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getData();
  },

  data() {
    return {
      tipos: []
    };
  },
  methods: {
    getData() {
      fetch("/api/tipos")
        .then(response => response.json())
        .then(json => {
          this.tipos = json.data;
        });
    }
  }
};
</script>

<style>
</style>