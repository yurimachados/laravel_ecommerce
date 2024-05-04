<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PriceInput from '@/Components/PriceInput.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';


let props = defineProps({
    product: {
        type: Object,
        required: true
    }
});

const form = useForm({
    name: props.product.name,
    price: props.product.price,
    description: props.product.description,
});


</script>
<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Product Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your product's information.
            </p>
            <form @submit.prevent="form.patch(route('products.update', {id: product.id}))" class="mt-6 space-6">
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

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mt-4">
                    <InputLabel for="description" value="Description" />

                    <TextAreaInput
                        id="description"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        required
                        autocomplete="description"
                    ></TextAreaInput>

                    <InputError class="mt-2" :message="form.errors.description" />
                </div>

                <div class="mt-4">
                    <InputLabel for="price" value="Price" />

                    <PriceInput
                        id="price"
                        class="mt-1 block w-full"
                        v-model="form.price"
                        required
                        autocomplete="price"
                    />

                    <InputError class="mt-2" :message="form.errors.price" />
                </div>

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
            </form>
        </header>
    </section>
</template>