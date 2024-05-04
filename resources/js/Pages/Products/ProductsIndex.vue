
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import { Head } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        DataTable,
        Head
    },
    props: {
        products: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            currentPage: 1
        }
    },
    mounted() {
        //
    },
    watch: {
        //
    }
}
</script>
<template>
    <Head title="Products" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>
        <DataTable
            :headers="[
                { text: 'Name', value: 'name' },
                { text: 'Price', value: 'price' },
                { text: 'Description', value: 'description'},
                { text: 'Actions', value: 'actions' }
            ]"
            :items="products"
            :currentPage.sync="currentPage"
            :perPage="20"
        >
            <template #name="{ item }">
                <div class="text-sm text-gray-900 name-column">{{ item.name }}</div>
            </template>
            <template #price="{ item }">
                <div class="text-sm text-gray-900">${{ item.price }}</div>
            </template>
            <template #description="{ item }">
                <div class="text-sm text-gray-900 description-column">{{ item.description }}</div>
            </template>
            <template #actions="{ item }">
                <div class="flex items-center options-column">
                    <a href="#" class="">
                        <FontAwesomeIcon :icon="['fas', 'ellipsis']" class="options-icon" />
                    </a>
                </div>
            </template>
        </DataTable>
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
