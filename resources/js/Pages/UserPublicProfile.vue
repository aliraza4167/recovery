<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    user: {
        type: Object,
    },
    pains: {
        type: Array,
    },
    profile: {
        type: Object,
    },
});

defineOptions({
    layout: AuthenticatedLayout,
});

const form = useForm({
    receiver_id: "",
});

const unfriend = (id) => {
    form.delete(`/friends/${id}`);
};

const createConversation = (id) => {
    form.post(route("conversations.store"), {
        onFinish: () => form.reset("message_body"),
    });
};
</script>

<template>
    <div class="py-12">
        <div class="bg-gray-100">
            <div class="container mx-auto py-8">
                <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                    <div class="col-span-4 sm:col-span-3">
                        <div class="bg-white shadow rounded-lg p-6">
                            <div class="flex flex-col items-center">
                                <img
                                    src="https://randomuser.me/api/portraits/men/94.jpg"
                                    class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0"
                                />

                                <h1 class="text-xl font-bold">
                                    {{ user.name }}
                                </h1>
                                <!-- <p
                                        class="text-gray-700"
                                        v-if="user.profile != null"
                                        v-text="user.profile.description"
                                    ></p> -->
                                <div
                                    class="mt-6 flex flex-wrap gap-4 justify-center"
                                >
                                    <button
                                        v-if="
                                            $page.props.auth.friends.some(
                                                (friend) =>
                                                    friend.id === user.id
                                            )
                                        "
                                        @click="unfriend(user.id)"
                                        class="border-1 bg-sky-100 hover:bg-red-100 p-2 rounded-md"
                                        type="button"
                                    >
                                        Unfriend
                                    </button>

                                    <Link
                                        v-else
                                        :href="`/friends/${user.id}`"
                                        method="post"
                                        as="button"
                                        type="button"
                                        class="border-1 bg-sky-100 hover:bg-blue-100 p-2 rounded-md"
                                        >Add Friend</Link
                                    >
                                    <form
                                        @submit.prevent="
                                            createConversation(user.id)
                                        "
                                    >
                                        <button
                                            type="submit"
                                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded"
                                        >
                                            Message
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <hr class="my-6 border-t border-gray-300" />
                            <div class="flex flex-col">
                                <span
                                    class="text-gray-700 uppercase font-bold tracking-wider mb-2"
                                    >Suffering from</span
                                >
                                <ul v-for="(pain, index) in pains" :key="index">
                                    <li class="mb-2">{{ pain.name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-9">
                        <div class="bg-white shadow rounded-lg p-6">
                            <h2 class="text-xl font-bold mb-4">About Me</h2>
                            <p
                                class="text-gray-700"
                                v-if="profile != null"
                                v-text="profile.description"
                            ></p>
                            <p v-else>The user has yet to fill this part</p>

                            <h2 class="text-xl font-bold my-4">Story</h2>
                            <p
                                class="text-gray-700"
                                v-if="profile != null"
                                v-text="profile.story"
                            ></p>
                            <p v-else>The user has yet to fill this part</p>

                            <h2 class="text-xl font-bold mt-6 mb-4">
                                Things that I went through
                            </h2>
                            <div
                                class="mb-6"
                                v-for="(pain, index) in pains"
                                :key="index"
                            >
                                <div
                                    class="flex justify-between flex-wrap gap-2 w-full"
                                >
                                    <span class="text-gray-700 font-bold">{{
                                        pain.name
                                    }}</span>
                                    <p>
                                        <span class="text-gray-700">{{
                                            new Date(
                                                pain.when
                                            ).toLocaleDateString("en-us", {
                                                weekday: "long",
                                                year: "numeric",
                                                month: "short",
                                                day: "numeric",
                                            })
                                        }}</span>
                                    </p>
                                </div>
                                <p class="mt-2" v-html="pain.description"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
