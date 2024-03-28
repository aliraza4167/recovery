<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    messages: Array,
});

const form = useForm({
    receiver_id: "",
    sender_id: "",
    conversation_id: "",
    messageBody: "",
});

const submit = () => {
    form.post(route("conversations.store"), {
        onFinish: () => form.reset("messageBody"),
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Conversations
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div>
                            <ul
                                v-for="(message, index) in messages"
                                :key="index"
                            >
                                <li>
                                    {{ message.body }} sent by
                                    {{ message.user.name }}
                                </li>
                            </ul>
                        </div>
                        <form @submit.prevent="submit">
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.messageBody"
                                required
                                autofocus
                            ></TextInput
                            ><PrimaryButton>Send</PrimaryButton>
                        </form>
                        <Link href="/conversations/create"
                            >Take me to conversation create page</Link
                        >
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
