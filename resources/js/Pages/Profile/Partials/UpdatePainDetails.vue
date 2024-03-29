<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Editor from "primevue/editor";
import AutoComplete from "primevue/autocomplete";
import Calendar from "primevue/calendar";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    aches: { type: Array },
});

const filteredAches = ref();
const pains = usePage().props.auth.pains;

const form = useForm({
    painName: "",
    painDescription: "",
    painWhen: "",
});

const search = (event) => {
    filteredAches.value = usePage().props.aches.filter((ache) => {
        return ache.name.toLowerCase().startsWith(event.query.toLowerCase());
    });
};

const focusOut = function () {
    if (filteredAches.value.length > 0) {
        form.painName = form.painName.name;
    }
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                What are you going through
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Update the pain that you are going through
            </p>
        </header>

        <div
            v-for="(pain, index) in pains"
            :key="index"
            class="flex justify-between rounded-md m-4 bg-blue-100 p-4"
        >
            <div>
                <h3>What are you going through?</h3>
                <div>{{ pain.name }}</div>
            </div>
            <div>
                <h3>What happened?</h3>
                <div v-html="pain.description"></div>
            </div>
            <div>
                <h3>When did it happen?</h3>
                <div>
                    {{
                        new Date(pain.when).toLocaleDateString("en-us", {
                            weekday: "long",
                            year: "numeric",
                            month: "short",
                            day: "numeric",
                        })
                    }}
                </div>
            </div>
        </div>
        <form
            @submit.prevent="
                form.post(route('profile.painUpdate'), {
                    onSuccess: () => form.reset(),
                })
            "
            class="mt-6 space-y-6"
        >
            <div class="">
                <div class="flex justify-between bg-blue-100 m-4 rounded-md">
                    <div class="m-4">
                        <div>
                            <InputLabel for="painName" value="What happened" />

                            <AutoComplete
                                v-model="form.painName"
                                optionLabel="name"
                                :suggestions="filteredAches"
                                @complete="search"
                                v-on:blur="focusOut"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.painName"
                            />
                        </div>
                    </div>

                    <div class="m-4">
                        <div>
                            <InputLabel
                                for="description"
                                value="What happened"
                            />
                            <Editor
                                v-model="form.painDescription"
                                editorStyle="height: 320px"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.painDescription"
                            />
                        </div>
                    </div>
                    <div class="m-4">
                        <div>
                            <InputLabel for="when" value="When did it happen" />
                            <Calendar
                                v-model="form.painWhen"
                                dateFormat="dd/mm/yy"
                                :manualInput="false"
                                showIcon
                                class="border rounded-md p-4"
                                placeholder="dd/mm/yy"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 m-4">
                    <PrimaryButton :disabled="form.processing"
                        >Save</PrimaryButton
                    >

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p
                            v-if="form.recentlySuccessful"
                            class="text-sm text-gray-600"
                        >
                            Saved.
                        </p>
                    </Transition>
                </div>
            </div>
        </form>
    </section>
</template>
