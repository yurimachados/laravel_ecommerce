<script setup>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { defineProps } from 'vue';

let props = defineProps({
    category: {
        type: Object,
        required: true
    }
});
const form = useForm({
    name: props.category.name
});

</script>
<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Category Information</h2>
            
            <p class="mt-1 text-sm text-gray-600">
                Update your category's information.
            </p>

            <form @submit.prevent="form.patch(route('categories.update', {id: category.id}))" class="mt-6 space-6">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <div class="flex items-center gap-4 mt-6">
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                        </Transition>
                    </div>

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
            </form>
        </header>

    </section>
</template>