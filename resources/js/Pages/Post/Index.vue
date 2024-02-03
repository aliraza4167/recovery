<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { stringify } from "postcss";

defineProps({
    posts: Array,
});

const form = useForm({});

const deletePost = (id) => {
    form.delete(`/posts/${id}`);
};
</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between">
                            <h2
                                class="font-bold text-center text-lg p-2 bg-gray-100 rounded-md"
                            >
                                List of your posts
                            </h2>
                            <Link
                                href="posts/create"
                                class="border-1 bg-sky-100 hover:bg-red-100 p-2 rounded-md"
                                >Create a new Post</Link
                            >
                        </div>
                        <br />
                        <div v-if="posts.length > 0">
                            <ul
                                v-for="(post, index) in posts"
                                :key="post.id"
                                class=""
                            >
                                <Link :href="`/posts/${post.id}`"
                                    ><div
                                        class="flex justify-between mx-auto w-full text-xl bg-gray-100 hover:bg-blue-100 p-4"
                                    >
                                        <li class="max-w-xl">
                                            {{ post.title }}
                                        </li>
                                        <li>
                                            <button
                                                @click="deletePost(post.id)"
                                                class="border-1 bg-sky-100 hover:bg-red-100 p-2 my-4 rounded-md"
                                                type="button"
                                            >
                                                Delete Post
                                            </button>
                                        </li>
                                    </div></Link
                                >
                            </ul>
                        </div>
                        <div v-else>No Posts found</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
