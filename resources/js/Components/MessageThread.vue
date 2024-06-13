<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    messages: {
        type: Array,
    },
    conversation_id: {
        type: Number,
    },
});

defineOptions({
    layout: AuthenticatedLayout,
});

const form = useForm({
    sender_id: "",
    conversation_id: "",
    message_body: "",
});

onMounted(() => {
    form.sender_id = usePage().props.auth.user.id;
    form.conversation_id = props.conversation_id;
});

let isOwnerOfMessage = (id) => {
    if (id == usePage().props.auth.user.id) {
        return "justify-end";
    } else {
        return "justify-start";
    }
};

const submit = () => {
    form.post(route("messages.store"), {
        onFinish: () => form.reset("message_body"),
    });
};
</script>

<template>
    <!-- message -->
    <div
        class="flex flex-col mt-5"
        v-for="(message, index) in messages"
        :key="index"
    >
        <div class="flex mb-4" v-bind:class="isOwnerOfMessage(message.user_id)">
            <div
                class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white"
            >
                {{ message.content }}
            </div>
            <img
                src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                class="object-cover h-8 w-8 rounded-full"
                alt=""
            />
        </div>
    </div>

    <!-- START OF THE TEXT FIELD FOR SENDING MESSAGE -->
    <div class="py-5">
        <form @submit.prevent="submit">
            <input
                v-model="form.message_body"
                class="w-full bg-gray-300 py-5 px-3 rounded-xl"
                type="text"
                placeholder="type your message here..."
                required
            />
        </form>
    </div>
    <!-- end message -->
</template>
