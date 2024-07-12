<script setup>
import { ref } from "vue";
import gravatar from "gravatar";
import { usePage } from "@inertiajs/vue3";
const menuOpen = ref(false);
const page = usePage();
const accountProfile = page.props.auth.user
    ? gravatar.url(page.props.auth.user.email) ??
      page.props.auth.user.profile_photo_url
    : "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80";
</script>
<template>
    <div class="grid grid-rows-2 relative" style="grid-template-rows: auto 1fr">
        <nav class="bg-gray-800 sticky top-0 z-10">
            <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div
                        class="flex flex-1 items-stretch justify-start"
                    >
                        <div class="flex items-center flex-shrink-0 mr-6">
                            <img
                                class="w-auto h-8"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company"
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
                                <Link
                                    class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white"
                                    :class="[
                                        route().current().includes('playlists')
                                            ? 'bg-gray-900 text-white'
                                            : 'text-gray-300 hover:bg-gray-700',
                                    ]"
                                    :href="route('playlists.index')"
                                    >Playlists</Link
                                >
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute inset-y-0 right-0 flex items-center pr-2"
                    >
                        <button
                            type="button"
                            class="relative p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">View notifications</span>
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
                                />
                            </svg>
                        </button>

                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <div>
                                <button
                                    type="button"
                                    class="relative flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    id="user-menu-button"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                    @click="menuOpen = !menuOpen"
                                >
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img
                                        class="w-8 h-8 rounded-full"
                                        :src="accountProfile"
                                        alt=""
                                    />
                                </button>
                            </div>

                            <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
                            <div
                                class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                                tabindex="-1"
                                v-if="menuOpen"
                            >
                                <!-- Active: "bg-gray-100", Not Active: "" -->
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="user-menu-item-0"
                                    >Your Profile</a
                                >
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="user-menu-item-1"
                                    >Settings</a
                                >
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="user-menu-item-2"
                                    >Sign out</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div v-if="menuOpen" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a
                        href="#"
                        class="block px-3 py-2 text-base font-medium text-white bg-gray-900 rounded-md"
                        aria-current="page"
                        >Dashboard</a
                    >
                    <a
                        href="#"
                        class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white"
                        >Team</a
                    >
                    <a
                        href="#"
                        class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white"
                        >Projects</a
                    >
                    <a
                        href="#"
                        class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white"
                        >Calendar</a
                    >
                </div>
            </div>
        </nav>
        <main class="py-3 mx-5">
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
