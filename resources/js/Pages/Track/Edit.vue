<script setup lang="ts">
import { useForm, usePage } from "@inertiajs/vue3";
import MusicLayout from "../../Layouts/MusicLayout.vue";
import { computed } from "vue";

const page = usePage<{
    track: any;
}>();

console.log('%cresources/js/Pages/Track/Edit.vue:10 page.props', 'color: white; background-color: #007acc;', page.props);

const track = computed(() => page.props.track);

const form = useForm(track.value);

function submit() {
    form.put(route("tracks.update", { track: track.value }));
}
</script>

<template>
    <MusicLayout></MusicLayout>

    <form @submit.prevent="submit" class="max-w-xl">
        <div class="flowbite_form_section group">
            <label for="title">Title</label>
            <input class="peer" v-model="form.title" type="text" id="title" />
        </div>
        <div class="flowbite_form_section group">
            <label for="artist">Artist</label>
            <input class="peer" v-model="form.artist" type="text" id="artist" />
        </div>
        <div class="flowbite_form_section group">
            <label for="album">Album</label>
            <input class="peer" v-model="form.album" type="text" id="album" />
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
