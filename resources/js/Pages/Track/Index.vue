<script setup lang="ts">
import MusicLayout from "../../Layouts/MusicLayout.vue";
import TrackList from "../../Components/Track/TrackList.vue";
import { ref, computed } from "vue";
import { useAudioPlayer } from "../../Composables/audioPlayer";
import { usePage } from "@inertiajs/vue3";

const page = usePage<{
    tracks: any[];
    isAdmin: boolean;
}>();

const tracks = computed(() => page.props.tracks);

const { currentTimeString, currentDurationString } = useAudioPlayer();

const inputSearch = ref("");
const filteredTracks = computed<any[] | undefined>(() => {
    if (!tracks.value) return;
    const toCompare = inputSearch.value.toLowerCase();
    return tracks.value.filter(
        (track) =>
            track.title.toLowerCase().includes(toCompare) ||
            track.artist.toLowerCase().includes(toCompare)
    );
});
</script>

<template>
    <MusicLayout>
        <template #title>
            <div class="flex gap-2">
                <i class="mdi mdi-music"></i>
                <h1>Available tracks</h1>
            </div>
        </template>
        <template #action v-if="page.props.isAdmin">
            <Link
                class="flex gap-2 flowbite_button_blue"
                :href="route('tracks.create')"
            >
                <i class="mdi mdi-plus-circle"></i>
                <p>Add track</p>
            </Link>
        </template>
        <template #content>
            <div>
                <form @submit.prevent class="mx-auto my-5">
                    <label
                        for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                        >Search</label
                    >
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3"
                        >
                            <i class="mdi mdi-magnify"></i>
                        </div>
                        <input
                            type="search"
                            id="default-search"
                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Title, Artist ..."
                            required
                            v-model="inputSearch"
                        />
                    </div>
                </form>
            </div>
            <TrackList v-if="filteredTracks" :tracks="filteredTracks">
                <template v-if="page.props.isAdmin" #controls="{ track }">
                    <div
                        class="flex divide-x divide-inherit bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                    >
                        <Link
                            :href="route('tracks.edit', { track })"
                            class="py-1 px-2"
                        >
                            <i class="mdi mdi-pencil"></i>
                        </Link>
                        <Link
                            :href="route('tracks.destroy', { track })"
                            method="delete"
                            as="button"
                            class="py-1 px-2"
                        >
                            <i class="mdi mdi-trash-can-outline"></i>
                        </Link>
                    </div>
                </template>
            </TrackList>
        </template>
    </MusicLayout>
</template>
