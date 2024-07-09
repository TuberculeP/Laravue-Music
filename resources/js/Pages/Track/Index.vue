<script setup lang="ts">
import MusicLayout from "../../Layouts/MusicLayout.vue";
import TrackListItem from "../../Components/Track/TrackListItem.vue";
import { useBetterProps } from "../../Composables/betterInertia";
const { tracks } = useBetterProps<{
    tracks: any[];
}>();
</script>

<template>
    <MusicLayout>
        <h1>Tracks</h1>
        <div class="grid grid-cols-2 gap-5" v-if="tracks">
            <TrackListItem
                v-for="track in tracks"
                :key="track.id"
                :track="track"
            />
        </div>
    </MusicLayout>
</template>
