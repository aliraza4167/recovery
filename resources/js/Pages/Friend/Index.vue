<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
// import { Inertia } from "@inertiajs/inertia";
import { stringify } from "postcss";

defineProps({
    friends: Array,
});

const form = useForm({});

const unfriend = (id) => {
    form.delete(`/friends/${id}`);
};
// function destroy(id) {
//     if (confirm("Are you sure you want to unfriend?")) {
//         form.delete(`friends/${id}`);
//     }
// }
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Friends
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2
                            class="font-bold text-center text-lg p-2 bg-gray-100 rounded-md"
                        >
                            List of your friends who you can chat with
                        </h2>
                        <br />
                        <div v-if="friends.length > 0">
                            <ul
                                v-for="(friend, index) in friends"
                                :key="friend.id"
                                class="flex justify-between space-y-2"
                            >
                                <li>{{ friend.name }}</li>
                                <li>
                                    <!-- <Link
                                        :href="`/friends/${friend.id}`"
                                        method="delete"
                                        as="button"
                                        type="button"
                                        class="border-1 bg-sky-100 hover:bg-red-100 p-2 rounded-md"
                                        :data="{ friend: friend.id }"
                                        >Unfriend</Link
                                    > -->
                                    <button
                                        @click="unfriend(friend.id)"
                                        class="border-1 bg-sky-100 hover:bg-red-100 p-2 rounded-md"
                                        type="button"
                                    >
                                        Unfriend
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div v-else>No Friends found</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
