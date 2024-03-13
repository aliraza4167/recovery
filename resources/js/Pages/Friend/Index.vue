<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
// import { Inertia } from "@inertiajs/inertia";
import { stringify } from "postcss";
import Dialog from "primevue/dialog";
import { ref } from "vue";
import UserPublicProfile from "../UserPublicProfile.vue";

defineProps({
    friends: Array,
});

const visible = ref(false);

const form = useForm({});

const unfriend = (id) => {
    form.delete(`/friends/${id}`);
};

const showProfile = function () {
    visible.value = !visible.value;
};
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
                                <!-- <Link :href="`user/${friend.id}`"
                                    ><li>{{ friend.name }}</li></Link
                                > -->
                                <li>
                                    <button @click="showProfile">
                                        {{ friend.name }}
                                    </button>
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
                                <Dialog
                                    v-model:visible="visible"
                                    modal
                                    :header="`${friend.name}`"
                                >
                                    <UserPublicProfile
                                        :user="friend"
                                        :profile="friend.profile"
                                    />
                                </Dialog>
                            </ul>
                        </div>
                        <div v-else>No Friends found</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
