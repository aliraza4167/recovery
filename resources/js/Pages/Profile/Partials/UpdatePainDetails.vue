<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import MultiSelect from "primevue/multiselect";
import AutoComplete from "primevue/autocomplete";
import Calendar from "primevue/calendar";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    aches: { type: Array },
});

const filteredAches = ref();
const user = usePage().props.auth.user;

const form = useForm({
    selectedPain: "",
    painName: "",
    painDescription: "",
    painWhen: "",
});

const search = (event) => {
    setTimeout(() => {
        if (!event.query.trim().length) {
            filteredAches.value = usePage().props.aches;
        } else {
            filteredAches.value = usePage().props.aches.filter((ache) => {
                return ache.name
                    .toLowerCase()
                    .startsWith(event.query.toLowerCase());
            });
        }
    }, 250);
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

        <form
            @submit.prevent="form.post(route('profile.painUpdate'))"
            class="mt-6 space-y-6"
        >
            <div class="">
                <!-- <div class="m-4 min-w-60">
                    <InputLabel
                        for="pain"
                        value="Select pain that you are going through"
                    />

                    <div>
                        <MultiSelect
                            v-model="form.selectedPain"
                            filter
                            :options="aches"
                            optionLabel="name"
                            :maxSelectedLabels="2"
                            placeholder="What are you going through?"
                            class="max-w-80 md:w-20rem"
                        >
                        </MultiSelect>
                    </div>

                    <InputError class="mt-2" :message="form.errors.pains" />
                </div> -->

                <div class="flex justify-between bg-blue-100 m-4 rounded-md">
                    <div class="m-4">
                        <div>
                            <InputLabel for="painName" value="What happened" />

                            <AutoComplete
                                v-model="form.painName"
                                optionLabel="name"
                                :suggestions="filteredAches"
                                @complete="search"
                            />

                            <!-- <InputError class="mt-2" :message="form.errors" /> -->
                        </div>
                    </div>

                    <div class="m-4">
                        <div>
                            <InputLabel
                                for="description"
                                value="What happened"
                            />

                            <textarea
                                v-model="form.painDescription"
                                rows="5"
                                cols="40"
                                name="description"
                                placeholder="What happened..."
                                class="border rounded-md"
                            ></textarea>

                            <!-- <InputError class="mt-2" :message="form.errors" /> -->
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
