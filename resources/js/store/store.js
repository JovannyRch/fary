import Vuex from "vuex";

window.Vue = require("vue");

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        count: 0,
        ads: []
    },
    mutations: {
        incrementCounter(state, payload) {
            state.count += payload;
        },
        updateAds(state, payload) {
            state.ads = payload;
        }
    },
    actions: {
        inrementAction(context, payload) {
            context.commit("incrementCounter", payload);
        },
        updateAction(context, payload) {
            context.commit("updateAds", payload);
        }
    },
    getters: {
        counter(state) {
            return state.count;
        },
        ads(state) {
            return state.ads;
        }
    }
});

export default store;
