<script setup lang="ts">
import MusicLayout from "../../Layouts/MusicLayout.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: null,
});

function submit() {
    form.post(route("api-keys.store"), {
        preserveState: false,
        preserveScroll: true,
        onSuccess: () => {
            console.log("uploaded");
            route("api-keys.index");
        },
    });
}
</script>

<template>
    <MusicLayout>
        <template #title>
            <h1>Create a new API Key</h1>
        </template>
        <template #action>
            <Link
                class="flowbite_button_blue flex gap-2"
                :href="route('api-keys.index')"
            >
                <i class="mdi mdi-arrow-left"></i>
                <p>Back to list</p>
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submit" class="max-w-xl">
                <div class="flowbite_form_section group">
                    <label for="title">Name</label>
                    <input
                        class="peer"
                        v-model="form.name"
                        type="text"
                        id="title"
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
                    Create
                </button>
            </form>
        </template>
    </MusicLayout>
</template>
