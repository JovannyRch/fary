import Vuex from "vuex";

window.Vue = require("vue");

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        ads: [],
        deleteId: 0
    },
    mutations: {
        updateAds(state, payload) {
            state.ads = payload;
        },
        setDeleteId(state, payload) {
            state.deleteId = payload;
        }
    },
    actions: {
        inrementAction(context, payload) {
            context.commit("incrementCounter", payload);
        },
        updateAction(context, payload) {
            context.commit("updateAds", payload);
        },
        setAction(context, payload) {
            context.commit("setDeleteId", payload);
        }
    },
    getters: {
        counter(state) {
            return state.count;
        },
        ads(state) {
            return state.ads;
        },
        deleteId(state) {
            return state.deleteId;
        }
    }
});

export default store;
