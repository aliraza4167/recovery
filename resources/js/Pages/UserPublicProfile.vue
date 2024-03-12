<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { stringify } from "postcss";

defineProps({
    user: {
        type: Object,
    },
    profile: {
        type: Object,
    },
});

const form = useForm({});

const unfriend = (id) => {
    form.delete(`/friends/${id}`);
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
                            <img
                                src="https://api.lorem.space/image/face?w=150&h=150"
                                alt="Face image"
                                width="100"
                                height="100"
                                class="rounded-md"
                            />
                            <h3
                                v-text="user.name"
                                class="inline-block align-middle"
                            ></h3>
                        </h2>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
