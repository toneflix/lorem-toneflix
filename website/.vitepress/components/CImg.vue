<template>
    <div class="image">
        <div class="image-preview image-container">
            <div class="image-bg"></div>
            <img v-bind="$attrs" class="VPImage image-src" :src="url" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";
import { baseURL } from "../theme/index";
const props = defineProps({
    src: { type: String, required: true },
});

const url = computed(() =>
    props.src.includes("http") ? props.src : baseURL + "/" + props.src
);
</script>
