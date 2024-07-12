<script setup lang="ts">
import MusicLayout from "../../Layouts/MusicLayout.vue";
import TrackListItem from "../../Components/Track/TrackListItem.vue";
import { ref, computed } from "vue";
import { useAudioPlayer } from "../../Composables/audioPlayer";
import { usePage } from "@inertiajs/vue3";
import moment from "moment";

const page = usePage<{
    playlists: any[];
}>();

const playlists = computed(() => page.props.playlists);
console.log(playlists);
</script>

<template>
    <MusicLayout>
        <template #title>
            <div class="flex gap-2">
                <i class="mdi mdi-folder"></i>
                <h1>My playlists</h1>
            </div>
        </template>
        <template #action>
            <Link
                class="flex gap-2 flowbite_button_blue"
                :href="route('playlists.create')"
            >
                <i class="mdi mdi-plus-circle"></i>
                <p>Add playlist</p>
            </Link>
        </template>
        <template #content>
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Tracks</th>
                        <th scope="col" class="px-6 py-3">Created at</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="border-b dark:border-gray-700"
                        v-for="(playlist, idx) in playlists"
                        :key="playlist.uuid"
                    >
                        <td scope="row" class="px-6 py-4">
                            {{ idx + 1 }}
                        </td>
                        <th
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ playlist.title }}
                        </th>
                        <td class="px-6 py-4">{{ playlist.tracks_count }}</td>
                        <td class="px-6 py-4">
                            {{
                                moment(playlist.created_at).format(
                                    "MM/DD/YYYY hh:mm:ss"
                                )
                            }}
                            ({{ moment(playlist.created_at).fromNow() }})
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <Link :href="route('playlists.show', { playlist })">
                                <i class="mdi mdi-eye text-gray-100"></i>
                            </Link>
                            <i class="mdi mdi-delete text-red-400"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </MusicLayout>
</template>
