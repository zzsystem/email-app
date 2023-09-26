<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const userMonogram = computed(() => {
    const splittedName = page.props.auth.user.name.split(' ');
    return splittedName.length > 1
        ? splittedName.shift().charAt(0).toUpperCase() + splittedName.pop().charAt(0).toUpperCase()
        : splittedName[0].charAt(0).toUpperCase();
});
</script>

<template>
    <FlashMessage/>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
            <div class="flex flex-col w-full">
                <header
                    class="h-16 w-full flex items-center relative justify-between px-5 space-x-10 bg-cyan-600 dark:bg-cyan-950 shadow"
                >
                    <div class="flex">
                        <div class="flex justify-center items-center">
                            <Link href="/">
                                <ApplicationLogo class="w-10 h-auto fill-current text-white" />
                            </Link>
                        </div>
                        <div class="py-6 px-4 sm:px-6 lg:px-8 text-white">
                            <slot name="header" />
                        </div>
                    </div>
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <div class="flex flex-shrink-0 items-center space-x-4 text-white cursor-pointer">
                                <div class="flex flex-col items-end">
                                    <div class="text-md font-medium">
                                        {{ $page.props.auth.user.name }}
                                    </div>
                                    <div class="text-md font-medium">
                                        {{ $page.props.auth.roles[0] }}
                                    </div>
                                </div>
                                <div
                                    class="h-10 w-10 rounded-full cursor-pointer bg-cyan-600 dark:bg-cyan-950 border-2 border-cyan-400 flex justify-center items-center"
                                >
                                    {{ userMonogram }}
                                </div>
                            </div>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </header>

                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
