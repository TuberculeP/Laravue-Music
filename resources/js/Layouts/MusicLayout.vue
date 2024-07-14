<script setup>
import { computed, ref } from "vue";
import gravatar from "gravatar";
import { usePage } from "@inertiajs/vue3";
const menuOpen = ref(false);
const page = usePage();
const isConnected = computed(() => !!page.props.auth.user);
const isAdmin = computed(() => page.props.isAdmin);
const accountProfile = computed(() =>
    isConnected.value
        ? gravatar.url(page.props.auth.user.email) ??
          page.props.auth.user.profile_photo_url
        : null
);
</script>
<template>
    <div class="grid grid-rows-2 relative" style="grid-template-rows: auto 1fr">
        <nav class="bg-gray-800 sticky top-0 z-10">
            <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="flex flex-1 items-stretch justify-start">
                        <div class="flex items-center flex-shrink-0 mr-6">
                            <img
                                class="w-auto h-8"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                alt="MusicApp"
                            />
                        </div>
                        <div>
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <Link
                                    class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white"
                                    :class="[
                                        route().current().includes('tracks')
                                            ? 'bg-gray-900 text-white'
                                            : 'text-gray-300 hover:bg-gray-700',
                                    ]"
                                    :href="route('tracks.index')"
                                    >Tracks</Link
                                >
                                <template v-if="isConnected">
                                    <Link
                                        class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white"
                                        :class="[
                                            route()
                                                .current()
                                                .includes('playlists')
                                                ? 'bg-gray-900 text-white'
                                                : 'text-gray-300 hover:bg-gray-700',
                                        ]"
                                        :href="route('playlists.index')"
                                        >Playlists</Link
                                    >
                                    <Link
                                        class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white"
                                        :class="[
                                            route()
                                                .current()
                                                .includes('api-keys')
                                                ? 'bg-gray-900 text-white'
                                                : 'text-gray-300 hover:bg-gray-700',
                                        ]"
                                        :href="route('api-keys.index')"
                                        >API Keys</Link
                                    >
                                </template>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute inset-y-0 right-0 flex items-center pr-2"
                    >
                        <!-- Profile dropdown -->
                        <div class="relative ml-3 flex items-center gap-4">
                            <template v-if="isConnected">
                                <div class="relative">
                                    <img
                                        class="w-8 h-8 rounded-full"
                                        :src="accountProfile"
                                        alt=""
                                    />
                                    <i
                                        v-if="isAdmin"
                                        class="flex absolute -bottom-3 -right-3 w-[24px] before:mx-auto rounded-full mdi bg-green-600 mdi-security border-gray-800 border-2 box-content"
                                    ></i>
                                </div>

                                <Link
                                    method="post"
                                    :href="route('logout')"
                                    as="button"
                                >
                                    <i class="mdi mdi-logout"></i>
                                </Link>
                            </template>
                            <template v-else>
                                <Link :href="route('login')">
                                    <div class="flowbite_button_blue">
                                        <i class="mdi mdi-login"></i> Login
                                    </div>
                                </Link>
                                <Link :href="route('register')">
                                    <div class="flowbite_button_blue">
                                        Register
                                    </div>
                                </Link>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-3 mx-auto max-w-7xl w-full sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-5">
                <div class="text-3xl font-bold">
                    <slot name="title" />
                </div>
                <div>
                    <slot name="action"></slot>
                </div>
            </div>
            <slot name="content" />
        </main>
    </div>
</template>
