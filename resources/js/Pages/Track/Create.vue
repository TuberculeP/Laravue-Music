<script setup>
import MusicLayout from "../../Layouts/MusicLayout.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    title: null,
    artist: null,
    visible: true,
    image: null,
    music: null,
    album: null,
});

function submit() {
    form.post(route("tracks.store"), {
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
            <h1>Create a new track</h1>
        </template>
        <template #action>
            <Link
                class="flowbite_button_blue flex gap-2"
                :href="route('tracks.index')"
            >
                <i class="mdi mdi-arrow-left"></i>
                <p>Back to list</p>
            </Link>
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
                <div class="flowbite_form_section group">
                    <label for="artist">Artist</label>
                    <input
                        class="peer"
                        v-model="form.artist"
                        type="text"
                        id="artist"
                    />
                </div>
                <div class="flowbite_form_section group">
                    <label for="cover">Cover</label>
                    <input
                        class="peer"
                        @change="(file) => (form.image = file.target.files[0])"
                        type="file"
                        accept="image/*"
                        id="cover"
                    />
                </div>

                <div class="flowbite_form_section group">
                    <label for="music">Music</label>
                    <input
                        class="peer"
                        @change="(file) => (form.music = file.target.files[0])"
                        type="file"
                        accept="audio/*"
                        id="music"
                    />
                </div>

                <div class="flex items-center mb-5">
                    <label for="visible">Visible</label>
                    <input
                        v-model="form.visible"
                        type="checkbox"
                        id="visible"
                    />
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
