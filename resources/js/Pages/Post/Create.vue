<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { stringify } from "postcss";

defineProps({
    posts: Array,
});

defineOptions({
    layout: AuthenticatedLayout,
});

const form = useForm({
    title: "",
    body: "",
});

let submit = () => {
    form.post("/posts", form);
};

const deletePost = (id) => {
    form.delete(`posts/${id}`);
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
                        Create a post
                    </h2>
                    <br />
                    <form
                        @submit.prevent="submit"
                        class="max-w-md mx-auto mt-8"
                    >
                        <div class="mb-6">
                            <label
                                for="title"
                                class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                >Title</label
                            >
                            <input
                                v-model="form.title"
                                type="text"
                                name="title"
                                placeholder="Title..."
                                class="border border-gray-400 p-2 w-full rounded-md"
                                required
                            />
                            <div
                                v-if="$page.props.errors.title"
                                v-text="$page.props.errors.title"
                                class="text-red-400 text-bold"
                            ></div>
                        </div>
                        <div class="mb-6">
                            <label
                                for="body"
                                class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                >Body</label
                            >
                            <textarea
                                v-model="form.body"
                                name="body"
                                id="body"
                                cols="30"
                                rows="10"
                                class="border border-gray-400 p-2 w-full rounded-md"
                                required
                            ></textarea>
                            <div
                                v-if="$page.props.errors.body"
                                v-text="$page.props.errors.body"
                                class="text-red-400 text-bold"
                            ></div>
                        </div>
                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                            >
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
