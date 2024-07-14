<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import { useAudioPlayer } from "../../Composables/audioPlayer";

const { requestPlay } = useAudioPlayer();
const { track } = defineProps({
    track: {
        type: Object,
        required: true,
    },
});

const url = "/storage/" + track.music;
const audio = new Audio(url);
</script>

<template>
    <div
        class="flex gap-4 justify-between items-center px-6 py-3 border rounded-lg shadow border-gray-700"
        :class="[!track.visible ? 'bg-gray-900 border-dashed' : 'bg-gray-800']"
        >
        <div
            class="w-24 h-24 bg-white rounded-lg bg-center bg-cover"
            :style="'background-image: url(/storage/' + track.image + ')'"
            :alt="track.title"
        />
        <div class="flex-1">
            <h5
                class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white"
            >
                {{ track.title }}
            </h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ track.artist }}
            </p>
        </div>
        <div class="flex items-center gap-4">
            <slot name="controls" :track></slot>
            <button
                @click="requestPlay(audio)"
                class="w-8 aspect-square text-sm font-medium text-center text-white rounded-full shadow-lg bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80"
            >
                <i class="mdi mdi-play"></i>
            </button>
        </div>
    </div>
</template>
