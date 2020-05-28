<template>
  <div class="container box-header">
    <div class="row">
      <div class="col-12 col-md-10">
        <div class="float-left pl-3">
          <h3 style=" color: #97222e;" v-show="user_id">
            Hola,
            <b>{{username}}</b>
          </h3>

          <div v-if="type == 'owner'">
            <div class="row">
              <div class="col-4 col-md-2">
                <img :src="negocio.img" class="img-thumbnail" />
              </div>
              <div class="col-8 col-md-8">
                <h3>
                  <b>{{negocio.name}}</b>
                </h3>
                <b>Cuenta de negocio</b>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-1 pr-4">
        <NotificationsComponent :user_id="user_id" v-if="user_id" />
      </div>
    </div>
  </div>
</template>

<script>
import NotificationsComponent from "../utils/NotificationsComponent";

export default {
  components: { NotificationsComponent },
  props: [],
  data() {
    return {
      user_id: document.querySelector('meta[name="user_id"]')
        ? document.querySelector('meta[name="user_id"]').getAttribute("content")
        : null,
      negocio: document.querySelector('meta[name="negocio"]')
        ? document.querySelector('meta[name="negocio"]').getAttribute("content")
        : null,
      username: document.querySelector('meta[name="username"]')
        ? document
            .querySelector('meta[name="username"]')
            .getAttribute("content")
        : null,
      type: document.querySelector('meta[name="type"]')
        ? document.querySelector('meta[name="type"]').getAttribute("content")
        : null
    };
  },
  created() {
    if (this.negocio) {
      this.negocio = JSON.parse(this.negocio);
    }
  }
};
</script>

<style>
.box-header {
  background: #fefefe;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  -webkit-box-shadow: -2px 6px 5px 0px rgba(222, 222, 222, 1);
  -moz-box-shadow: -2px 6px 5px 0px rgba(222, 222, 222, 1);
  box-shadow: -2px 6px 5px 0px rgba(222, 222, 222, 1);
  border-bottom: 3px solid #a73b46;
}
</style>