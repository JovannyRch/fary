<template>
    <div>
        <div v-for="(ad, index) in ads" :key="index" class="text-center mt-4">
            <img class="img-thumbnail" @click="clickAd(index)" :src="ad.url" />
        </div>
    </div>
</template>

<script>
export default {
    props: ["part"],
    components: {},
    data() {
        return {};
    },
    computed: {
        ads() {
            let n = this.$store.getters.ads.length;
            let ads = [];
            for (let i = 0; i < n / 2; i++) {
                ads.push(this.$store.getters.ads[i]);
            }
            return ads;
        }
    },
    mounted() {},
    methods: {
        isVideo(src) {
            return src.endsWith("mp4");
        },
        clickAd(index) {
            this.$emit("clickAd", index);
        }
    }
};
</script>

<style></style>
