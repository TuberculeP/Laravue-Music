<script setup lang="ts">
import MusicLayout from "@/Layouts/MusicLayout.vue";
import { useBetterProps } from "../../Composables/betterInertia";
const { tracks } = useBetterProps<{
    tracks: any[];
}>();
</script>

<template>
    <MusicLayout>
        <h1>Tracks</h1>
        <div class="w-fit" v-if="tracks">
            <div
                class="flex items-center justify-between"
                v-for="track in tracks"
                :key="track.id"
            >
                <h2>{{ track.title }}</h2>
                <p>{{ track.artist }}</p>
            </div>
        </div>
    </MusicLayout>
</template>
