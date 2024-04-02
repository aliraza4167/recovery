<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Avatar from "primevue/avatar";

defineProps({
    users: Array,
});

defineOptions({
    layout: AuthenticatedLayout,
});
</script>

<template>
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
                        class="flex justify-between space-y-4"
                    >
                        <Link :href="`user/` + user.id">
                            <li>
                                <Avatar
                                    :label="Array.from(user.name)[0]"
                                    class="mr-2 hover:bg-red-100"
                                    size="large"
                                />
                                {{ user.name }}
                            </li>
                        </Link>
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
</template>
