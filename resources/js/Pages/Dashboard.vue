<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    users: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2
                            class="font-bold text-center text-lg p-2 bg-gray-100 rounded-md"
                        >
                            List of all users:
                        </h2>
                        <br />
                        <ul
                            v-for="(user, index) in users"
                            :key="user.id"
                            class="flex justify-between space-y-2"
                        >
                            <li v-text="user.name"></li>
                            <Link
                                :href="`/friends/${user.id}`"
                                method="post"
                                as="button"
                                type="button"
                                class="border-1 bg-sky-100 hover:bg-blue-100 p-2 rounded-md"
                                >Add Friend</Link
                            >
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
