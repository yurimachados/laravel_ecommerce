<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    category:{
        type: Object,
        required: true
    }
})

const confirmingCategoryDeletion = ref(false);
const category = props.category;

const form = useForm({
    password: ''
});

const confirmCategoryDeletion = () => {
    confirmingCategoryDeletion.value = true;
};

const deleteCategory = () => {
    form.delete(route('categories.destroy', { id: category.id }), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingCategoryDeletion.value = false;
    form.reset();
};

</script>
<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Category</h2>
            
            <p class="mt-1 text-sm text-gray-600">
                Once your category is deleted, all of its resources and data will be permanently deleted. Before deleting
                your category, please download any data or information that you wish to retain.
            </p>
        </header>
        <DangerButton @click="confirmCategoryDeletion">Delete Category</DangerButton>

        <Modal :show="confirmingCategoryDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete this category?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    If you delete this category, all of its resources and data will be permanently deleted. Before deleting
                    this category, please download any data or information that you wish to retain.
                </p>

                <form @submit.prevent="deleteCategory" class="mt-6 space-y-6">

                    <div class="flex justify-end space-x-4">
                        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                        <DangerButton @click="deleteCategory">Delete Category</DangerButton>
                    </div>
                </form>
            </div>
        </Modal>
        
    </section>

</template>