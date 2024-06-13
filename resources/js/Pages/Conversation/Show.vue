<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    messages: Array,
    conversation: Object,
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
    form.conversation_id = usePage().props.conversation.id;
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
    <!-- This is an example component -->
    <div class="container mx-auto shadow-lg rounded-lg">
        <!-- Chatting -->
        <div class="flex flex-row justify-between bg-white">
            <!-- chat list -->
            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                <!-- search compt -->
                <div class="border-b-2 py-4 px-2">
                    <input
                        type="text"
                        placeholder="search chatting"
                        class="py-2 px-2 border-2 border-gray-200 rounded-2xl w-full"
                    />
                </div>
                <!-- end search compt -->
                <!-- user list -->
                <div
                    class="flex flex-row py-4 px-2 justify-center items-center border-b-2"
                >
                    <div class="w-1/4">
                        <img
                            src="https://source.unsplash.com/_7LbC5J-jw4/600x600"
                            class="object-cover h-12 w-12 rounded-full"
                            alt=""
                        />
                    </div>
                    <div class="w-full">
                        <div class="text-lg font-semibold">
                            <!-- <button :on-click="makeAxiosCall(conversation.id)">
                                {{ conversation.name }}
                            </button> -->
                            <h2>{{ conversation.name }}</h2>
                        </div>
                    </div>
                </div>

                <!-- end user list -->
            </div>
            <!-- end chat list -->

            <!-- message -->
            <div class="w-full px-5 flex flex-col justify-between">
                <div
                    class="flex flex-col mt-5"
                    v-for="(message, index) in messages"
                    :key="index"
                >
                    <div
                        class="flex mb-4"
                        v-bind:class="isOwnerOfMessage(message.user_id)"
                    >
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
            </div>
            <!-- end message -->
        </div>
    </div>
</template>
