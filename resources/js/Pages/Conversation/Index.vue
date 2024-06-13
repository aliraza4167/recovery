<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MessageThread from "@/Components/MessageThread.vue";
import Show from "./Show.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { getCurrentInstance, onMounted } from "vue";
import { stringify } from "postcss";
import { ref } from "vue";
import axios from "axios";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    conversations: {
        type: Array,
    },
    message_count: {
        type: Array,
    },
});

defineOptions({
    layout: AuthenticatedLayout,
});

const conversationSelected = ref(false);
const selected_conversation_id = ref();
const messages = ref();

const form = useForm({
    sender_id: "",
    conversation_id: "",
    message_body: "",
});

const submit = () => {
    form.post(route("conversations.store"), {
        onFinish: () => form.reset("messageBody"),
    });
};

function makeAxiosCall(conversation_id) {
    axios.get("https://catfact.ninja/fact").then(function (response) {
        console.log(response);
        console.log(response.data.fact);
        console.log(conversation_id);
    });
}

function getMessagesForConversation(conversation_id) {
    fetch("/conversations/" + conversation_id + "/edit") // api for the get request
        .then((response) => response.json())
        .then((data) => {
            selected_conversation_id.value = conversation_id;
            messages.value = data;
            conversationSelected.value = true;
        });
}
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
                        <span
                            ><button
                                @click="
                                    getMessagesForConversation(conversation.id)
                                "
                            >
                                Make axios call
                            </button></span
                        >
                        <!-- <InputLabel :value="conversation.id"></InputLabel> -->
                    </div>
                </div>

                <!-- end user list -->
            </div>
            <!-- end chat list -->

            <!-- message -->
            <div class="w-full px-5 flex flex-col justify-between">
                <MessageThread
                    v-if="conversationSelected"
                    :messages="messages"
                    :conversation_id="selected_conversation_id"
                />
                <!-- <div class="py-5">
                    <form @submit.prevent="submit">
                        <input
                            v-model="form.message_body"
                            class="w-full bg-gray-300 py-5 px-3 rounded-xl"
                            type="text"
                            placeholder="type your message here..."
                            required
                        />
                    </form>
                </div> -->
            </div>
            <!-- end message -->
        </div>
    </div>
</template>
