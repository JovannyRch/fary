<template>
  <div v-show="cars.length || posts.length">
    <div class="box">
      <div class="notifications">
        <i class="fas fa-bell"></i>
        <span class="num">{{size}}</span>
        <ul class="list">
          <li @click="updateNotification(p,'posts')" v-for="p in posts" :key="p.id">
            <router-link :to="'/post/'+p.post_id">
              <span class="icon">
                <i class="fa fa-wrench"></i>
              </span>
              <span class="text">
                <span class="user">{{p.user}}</span>:
                <i style="font-size: 1.0">{{p.comment}}</i>
              </span>
            </router-link>
          </li>
          <li @click="updateNotification(c,'cars')" v-for="c in cars" :key="c.id+'c'">
            <router-link :to="'/car/'+c.post_id">
              <span class="icon">console.log("Aqui ando");</span>
              <span class="text">
                <span class="user">{{c.user}}</span>:
                <i style="font-size: 1.0">{{c.comment}}</i>
              </span>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user_id"],
  data() {
    return {
      cars: [],
      posts: []
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      fetch("/api/notifications/" + this.user_id)
        .then(response => response.json())
        .then(json => {
          let data = json.data;
          this.cars = data.cars;
          this.posts = data.posts;
        });
    },
    updateNotification(post, type) {
      if (post.visto == 0) {
        post.visto = 1;
        fetch(`/api/notifications/${type}/${post.id}`, {
          method: "put"
        });
      }
    }
  },
  computed: {
    size() {
      return (
        this.posts.filter(p => p.visto == 0).length +
        this.cars.filter(p => p.visto == 0).length
      );
    }
  }
};
</script>

<style>
.box {
  float: right;
  position: relative;
  z-index: 10;
}

.notifications {
  width: 60px;
  height: 60px;
  background: #fff;
  border-radius: 30px;
  box-sizing: border-box;
  text-align: center;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.notifications .fas {
  color: #cecece;
  line-height: 60px;
  font-size: 30px;
}

.notifications .num {
  position: absolute;
  top: 0px;
  right: -5px;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #c70518;
  color: #fff;
  line-height: 25px;
  font-family: sans-serif;
  text-align: center;
}

.notifications:hover {
  width: 300px;
  height: 60px;
  text-align: left;
  padding: 0 15px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

@media (max-width: 600px) {
  .notifications:hover {
    width: 100%;
    height: 60px;
    text-align: left;
    padding: 0 15px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }
}

.notifications:hover .num {
  position: relative;
  background: transparent;
  columns: #fff;
  font-size: 24px;
  top: -4px;
}

.notifications:hover .num:after {
  content: "Notificaciones";
  color: #717171;
}

.notifications:hover ul {
  display: block;
}
.list {
  position: absolute;
  background: #fff;
  left: 0;
  top: 60px;
  margin: 0;
  padding: 20px;
  width: 100%;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
  box-sizing: border-box;
  display: none;

  border-bottom-left-radius: 30px;
  border-bottom-right-radius: 30px;
}

.list li {
  list-style: none;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding: 8px 0;
  display: flex;
  text-overflow: ellipsis;
}

.list li:last-child {
  border-bottom: none;
}
.list li .icon {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  text-align: center;
  line-height: 24px;
  margin-right: 15px;
}

.list li .icon .fas {
  color: #97222e;
  font-size: 24px;
  line-height: 24px;
}
.list li .icon .fa {
  color: #97222e;
  font-size: 24px;
  line-height: 24px;
}
.user {
  color: #97222e;
}

.list li .text {
  position: relative;
  font-family: sans-serif;
  top: 3px;
  cursor: pointer;
}

.list li:hover .text {
  font-weight: bold;
  color: #97222e;
}
</style>