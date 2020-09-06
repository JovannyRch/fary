import Vuex from "vuex";

window.Vue = require("vue");

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        ads: [],
        deleteId: 0,
        location: false,
        coords: {
            lat: null,
            long: null
        }
    },
    mutations: {
        updateAds(state, payload) {
            state.ads = payload;
        },
        setDeleteId(state, payload) {
            state.deleteId = payload;
        },
        setLocation(state, payload) {
            state.location = payload;
        },
        setCoords(state, payload) {
            state.coords = { ...payload };
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
        },
        updateLocationAction(context, payload) {
            context.commit("setLocation", payload);
        },
        setCoords(context, payload) {
            console.log("Actualizando localizacion", payload);
            context.commit("setCoords", payload);
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
        },
        location(state) {
            return state.location;
        },
        coords(state) {
            return state.coords;
        }
    }
});

export default store;
