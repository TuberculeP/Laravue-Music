<script setup lang="ts">
import TrackListItem from "../../Components/Track/TrackListItem.vue";
const { selectable, tracks } = defineProps<{
    selectable?: boolean;
    tracks: any[];
}>();
</script>

<template>
    <div class="flex flex-col gap-5 mx-auto" v-if="tracks">
        <TrackListItem
            v-for="track in tracks"
            :key="track.id"
            :track="track"
        >
            <template #controls="{ track }">
                <slot name="controls" :track />
            </template>
        </TrackListItem>
    </div>
</template>
