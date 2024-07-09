<script setup lang="ts">
import { defineProps } from "vue";
import { useAudioPlayer } from "../../Composables/audioPlayer";
const { requestPlay } = useAudioPlayer();
const { track } = defineProps({
    track: {
        type: Object,
        required: true,
    },
});
const url = "storage/" + track.music;
const audio = new Audio(url);
</script>

<template>
    <div class="flex items-center justify-between p-3 bg-slate-200">
        <img class="w-16" :src="'storage/' + track.image" :alt="track.title" />
        <div>
            <h2>{{ track.title }}</h2>
            <p>{{ track.artist }}</p>
        </div>
        <button
            @click="requestPlay(audio)"
            class="text-white bg-blue-600 text-wrap"
        >
            play !
        </button>
    </div>
</template>
