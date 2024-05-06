<script setup>
import AutenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdateCategoryForm from '@/Pages/Products/Partials/UpdateCategoryForm.vue';
import DeleteCategoryForm from '@/Pages/Products/Partials/DeleteCategoryForm.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    category: {
        type: Object,
        required: true
    }
})

</script>
<template>
    <Head :title="category.name" />
    <AutenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ category.name }}</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateCategoryForm 
                        :category="category" 
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteCategoryForm 
                        :category="category" 
                        class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AutenticatedLayout>

</template>