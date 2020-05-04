<template>
  <span class="date">{{formatDate(date)}}</span>
</template>

<script>
import TimeAgo from "javascript-time-ago";
import es from "javascript-time-ago/locale/es";
TimeAgo.addLocale(es);
const timeAgo = new TimeAgo("es-MX");

export default {
  props: ["date"],
  methods: {
    formatDate(date) {
      if (date) {
        let arrTime;
        if (date.indexOf("T") >= 0) {
          arrTime = date.split("T");
        } else {
          arrTime = date.split(" ");
        }
        let fecha = arrTime[0].split("-");
        let tiempo = arrTime[1].split(".")[0].split(":");

        let fechaJs = new Date(
          fecha[0],
          fecha[1] - 1,
          fecha[2],
          tiempo[0] - 5,
          tiempo[1],
          tiempo[2]
        );
        return timeAgo.format(fechaJs);
      }
      return "--";
    }
  }
};
</script>

<style>
.date {
  color: #d3d1d1;
  font-weight: 600;
  font-size: 0.7em;
  margin-right: 10px;
}
</style>