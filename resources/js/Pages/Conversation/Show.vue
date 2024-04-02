<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    messages: Array,
});

defineOptions({
    layout: AuthenticatedLayout,
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
    <!-- message -->
    <div class="w-full px-5 flex flex-col justify-between">
        <div
            class="flex flex-col mt-5"
            v-for="(message, index) in messages"
            :key="index"
        >
            <div class="flex justify-end mb-4">
                <div
                    class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white"
                >
                    {{ message.body }}
                </div>
                <img
                    src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                    class="object-cover h-8 w-8 rounded-full"
                    alt=""
                />
            </div>
        </div>
        <div class="py-5">
            <form @submit.prevent="submit">
                <input
                    v-model="form.messageBody"
                    class="w-full bg-gray-300 py-5 px-3 rounded-xl"
                    type="text"
                    placeholder="type your message here..."
                    required
                />
            </form>
        </div>
    </div>
    <!-- end message -->
</template>
