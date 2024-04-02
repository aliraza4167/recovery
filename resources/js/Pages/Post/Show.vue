<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { stringify } from "postcss";

defineProps({
    post: Object,
});

defineOptions({
    layout: AuthenticatedLayout,
});

const form = useForm({});

const deletePost = (id) => {
    form.delete(`/posts/${id}`);
};
</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div
                        class="flex justify-between mx-auto w-full text-xl bg-gray-100 hover:bg-blue-100 p-4"
                    >
                        <h2 class="max-w-xl">
                            {{ post.title }}
                        </h2>
                        <Link
                            :href="`/posts/${post.id}/edit`"
                            class="border-1 bg-sky-100 hover:bg-red-100 p-2 rounded-md"
                            >Edit</Link
                        >
                    </div>
                    <br />
                    <div class="mb-6">
                        <!-- <p>{{ post.title }}</p> -->
                        <p>{{ post.body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
