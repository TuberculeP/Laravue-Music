<script setup lang="ts">
import MusicLayout from "../../Layouts/MusicLayout.vue";
import { usePage } from "@inertiajs/vue3";
import moment from "moment";
import { computed } from "vue";

const page = usePage<{
    apiKeys: any[];
}>();

const apiKeys = computed(() => page.props.apiKeys);
</script>

<template>
    <MusicLayout>
        <template #title>
            <div class="flex gap-2">
                <i class="mdi mdi-key"></i>
                <h1>My API Keys</h1>
            </div>
        </template>
        <template #action>
            <Link
                class="flex gap-2 flowbite_button_blue"
                :href="route('api-keys.create')"
            >
                <i class="mdi mdi-plus-circle"></i>
                <p>Add API Key</p>
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
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Key</th>
                        <th scope="col" class="px-6 py-3">Created at</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="border-b dark:border-gray-700"
                        v-for="(apiKey, idx) in apiKeys"
                        :key="apiKey.uuid"
                    >
                        <td scope="row" class="px-6 py-4">
                            {{ idx + 1 }}
                        </td>
                        <th
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ apiKey.name }}
                        </th>
                        <td class="px-6 py-4">{{ apiKey.key }}</td>
                        <td class="px-6 py-4">
                            {{
                                moment(apiKey.created_at).format(
                                    "MM/DD/YYYY hh:mm:ss"
                                )
                            }}
                            ({{ moment(apiKey.created_at).fromNow() }})
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <Link
                                :href="
                                    route('api-keys.destroy', {
                                        api_key: apiKey,
                                    })
                                "
                                method="delete"
                            >
                                <i class="mdi mdi-delete text-red-400"></i>
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </MusicLayout>
</template>
