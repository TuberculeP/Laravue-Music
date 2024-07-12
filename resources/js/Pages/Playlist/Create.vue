<script setup lang="ts">
import { computed } from "vue";
import MusicLayout from "../../Layouts/MusicLayout.vue";
import TrackListItem from "../../Components/Track/TrackListItem.vue";
import { useForm, usePage } from "@inertiajs/vue3";

const form = useForm({
    title: null,
    tracks: [],
});

const page = usePage<{
    tracks: any[];
}>();

const tracks = computed(() => page.props.tracks);

function submit() {
    form.post(route("playlists.store"), {
        preserveState: false,
        preserveScroll: true,
        onSuccess: () => {
            console.log("uploaded");
        },
    });
}
</script>

<template>
    <MusicLayout>
        <template #title>
            <h1>Create a new playlist</h1>
        </template>
        <template #content>
            <form @submit.prevent="submit" class="max-w-xl">
                <div class="flowbite_form_section group">
                    <label for="title">Title</label>
                    <input
                        class="peer"
                        v-model="form.title"
                        type="text"
                        id="title"
                    />
                </div>
                <div v-for="track in tracks" :key="track.uuid">
                    <div class="flex items-center gap-6 max-h-screen">
                        <input
                            type="checkbox"
                            name=""
                            id=""
                            :value="track.uuid"
                            v-model="form.tracks"
                        />
                        <TrackListItem :track="track" :with-controls="false" />
                    </div>
                </div>
                <button
                    :disabled="form.processing"
                    class="px-3 py-1 text-white rounded-lg w-fit text-wrap"
                    :class="[
                        form.processing
                            ? 'bg-gray-500'
                            : 'bg-blue-600 hover:bg-blue-900',
                    ]"
                    type="submit"
                >
                    Submit
                </button>
            </form>
        </template>
    </MusicLayout>
</template>
