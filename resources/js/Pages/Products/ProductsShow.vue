
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdateProductInformation from '@/Pages/Products/Partials/UpdateProductInformation.vue';
import { Head } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        UpdateProductInformation
    },
    props: {
        product: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            //
        }
    }
}
</script>
<template>
    <Head :title=" product.name " />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ product.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProductInformation 
                        :product="product" 
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <!-- <DeleteProductForm 
                        :product="product" 
                    /> -->
                </div>
            </div>  
        </div>
    </AuthenticatedLayout>
</template>
<style scoped lang="scss">
@import '../../../sass/variables.scss';
.description-column {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.name-column {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.options-column {
    justify-content: start;
    padding-left: 1.8em;
}
.options-icon{
    font-size: 1.5rem;
    cursor: pointer;
    color: $p-color-800;
}
</style>
