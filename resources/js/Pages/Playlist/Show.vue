<script setup lang="ts">
import MusicLayout from "../../Layouts/MusicLayout.vue";
import TrackList from "@/Components/Track/TrackList.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage<{
    playlist: any;
    tracks: any[];
}>();

const playlistDetails = page.props.playlist;
const tracks = page.props.tracks;
</script>

<template>
    <MusicLayout>
        <template #title>
            <h1>{{ playlistDetails.title }}</h1>
        </template>
        <template #action>
            <div class="flex gap-2">
                <Link
                    class="flowbite_button_blue flex gap-2"
                    :href="
                        route('playlists.edit', {
                            playlist: page.props.playlist,
                        })
                    "
                >
                    <i class="mdi mdi-pencil"></i>
                    <p>Edit playlist</p>
                </Link>
                <Link
                    class="flowbite_button_blue flex gap-2"
                    :href="route('playlists.index')"
                >
                    <i class="mdi mdi-arrow-left"></i>
                    <p>Back to list</p>
                </Link>
            </div>
        </template>
        <template #content>
            <TrackList :tracks="tracks">
                <template #controls="{ track }">
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
