<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const props = defineProps({
    product: {
        type: Object,
        required: true,
    }
});

const confirmingProductDeletion = ref(false);
const passwordInput = ref(null);
const product = props.product;

const form = useForm({
    password: '',
});

const confirmProductDeletion = () => {
    confirmingProductDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteProduct = () => {
    form.delete(route('products.destroy', { id: product.id }), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingProductDeletion.value = false;

    form.reset();
};

</script>
<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Product</h2>
            
            <p class="mt-1 text-sm text-gray-600">
                Once your product is deleted, all of its resources and data will be permanently deleted. Before deleting
                your product, please download any data or information that you wish to retain.
            </p>
        </header>

        <DangerButton @click="confirmProductDeletion">Delete Product</DangerButton>

        <Modal :show="confirmingProductDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete this product?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your product is deleted, all of its resources and data will be permanently deleted. Please
                    type your password to confirm you would like to permanently delete this product.
                </p>

                <form @submit.prevent="deleteProduct" class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="password" value="Password" />

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            ref="passwordInput"
                            autocomplete="current-password"
                        />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex justify-end space-x-4">
                        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                        <DangerButton type="submit">Delete Product</DangerButton>
                    </div>
                </form>
            </div>
        </Modal>

    </section>
</template>