<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Show from "./Show.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { stringify } from "postcss";
import { ref } from "vue";

defineProps({
    conversations: Array,
});

defineOptions({
    layout: AuthenticatedLayout,
});

const conversationSelected = ref(false);
const messages = ref();

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

const selectConversation = (msg) => {
    conversationSelected.value = true;
    messages.value = msg;
    console.log(msg);
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
                    v-for="(conversation, index) in conversations"
                    :key="index"
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
                            <Link :href="`conversations/` + conversation.id">{{
                                conversation.name
                            }}</Link>
                        </div>
                    </div>
                </div>

                <!-- end user list -->
            </div>
            <!-- end chat list -->
        </div>
    </div>
</template>
