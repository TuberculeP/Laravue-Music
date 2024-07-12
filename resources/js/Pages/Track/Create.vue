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
    <MusicLayout></MusicLayout>
    <form class="max-w-sm mx-auto">
        <div class="mb-5">
            <label
                for="email"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Your email</label
            >
            <input
                type="email"
                id="email"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="name@flowbite.com"
                required
            />
        </div>
        <div class="mb-5">
            <label
                for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Your password</label
            >
            <input
                type="password"
                id="password"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                required
            />
        </div>
        <div class="mb-5">
            <label
                for="repeat-password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Repeat password</label
            >
            <input
                type="password"
                id="repeat-password"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                required
            />
        </div>
        <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
                <input
                    id="terms"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                    required
                />
            </div>
            <label
                for="terms"
                class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300"
                >I agree with the
                <a
                    href="#"
                    class="text-blue-600 hover:underline dark:text-blue-500"
                    >terms and conditions</a
                ></label
            >
        </div>
        <button
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
            Register new account
        </button>
    </form>

    <form @submit.prevent="submit">
        <div>
            <label for="title">Title</label>
            <input v-model="form.title" type="text" id="title" />
        </div>
        <div>
            <label for="artist">Artist</label>
            <input v-model="form.artist" type="text" id="artist" />
        </div>
        <div>
            <label for="image">Image</label>
            <input
                @change="(file) => (form.image = file.target.files[0])"
                type="file"
                accept="image/*"
                id="image"
            />
        </div>
        <div>
            <label for="music">Music</label>
            <input
                @change="(file) => (form.music = file.target.files[0])"
                type="file"
                accept="audio/*"
                id="music"
            />
        </div>
        <div>
            <label for="album">Album</label>
            <input v-model="form.album" type="text" id="album" />
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
        {{ form }}
    </form>
</template>
