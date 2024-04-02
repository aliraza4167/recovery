<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Avatar from "primevue/avatar";

defineProps({
    friends: Array,
});

defineOptions({
    layout: AuthenticatedLayout,
});

const form = useForm({});

const unfriend = (id) => {
    form.delete(`/friends/${id}`);
};
</script>

<template>
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
                        <ul v-for="(friend, index) in friends" :key="friend.id">
                            <div
                                class="flex justify-between space-y-4 rounded-md"
                            >
                                <li>
                                    <Link :href="`user/` + friend.id">
                                        <Avatar
                                            :label="Array.from(friend.name)[0]"
                                            class="mr-2 hover:bg-red-100"
                                            size="large"
                                        />
                                        {{ friend.name }}
                                    </Link>
                                </li>

                                <li>
                                    <button
                                        @click="unfriend(friend.id)"
                                        class="border-1 bg-sky-100 hover:bg-red-100 p-2 rounded-md"
                                        type="button"
                                    >
                                        Unfriend
                                    </button>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <div v-else>No Friends found</div>
                </div>
            </div>
        </div>
    </div>
</template>
