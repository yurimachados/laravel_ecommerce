
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import Chip from '@/Components/Chip.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components: {
        AuthenticatedLayout,
        DataTable,
        Head,
        Chip
    },
    props: {
        products: {
            type: Array,
            required: true
        },
        initialTab : {
            type: String,
            default: 'products'
        }
    },
    data() {
        return {
            currentPage: 1,
            tab: this.initialTab,
            categories: []
        }
    },
    mounted() {
        this.populateCategories();
    },
    watch: {
        //
    },
    methods: {
        populateCategories() {
            axios.get(route('categories.index'))
                .then(response => {
                    this.categories = response.data.categories;

                })
                .catch(error => console.error('Error:', error))
        }
    }
}
</script>
<template>
    <Head title="Products" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products Admin</h2>

            <div class="py-3">
                <div class="max-w-7xl mx-auto test">
                    <div class="product-admin-nav">
                        <button :class="tab === 'products' ? 'selected-nav-option' : 'nav-option'" @click="tab = 'products'">Products</button>   
                        <button :class="tab === 'categories' ? 'selected-nav-option' : 'nav-option'" @click="tab = 'categories'">Categories</button>
                    </div>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" v-show="tab === 'products'">
                <DataTable
                    :headers="[
                        { text: 'Name', value: 'name' },
                        { text: 'Price', value: 'price' },
                        { text: 'Description', value: 'description'},
                        { text: 'Categories', value: 'categories'},
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
                    <template #categories="{ item }">
                        <div class="text-sm text-gray-900">
                            <Chip v-for="category in item.categories" :key="category.id" :item="category.name" />
                        </div>
                    </template>
                    <template #actions="{ item }">
                        <div class="flex items-center options-column">
                            <a :href="route('products.show',{id: item.id})">
                                <FontAwesomeIcon :icon="['fas', 'ellipsis']" class="options-icon" />
                            </a>
                        </div>
                    </template>
                </DataTable>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" v-show="tab === 'categories'">
                <DataTable
                    :headers="[
                        { text: 'Name', value: 'name' },
                        { text: 'Actions', value: 'actions' }
                    ]"
                    :items="categories"
                    :currentPage.sync="currentPage"
                    :perPage="20"
                >
                    <template #name="{ item }">
                        <div class="text-sm text-gray-900 name-column">{{ item.name }}</div>
                    </template>
                    <template #actions="{ item }">
                        <div class="flex items center options-column">
                            <a :href="route('categories.show', {id: item.id})">
                                <FontAwesomeIcon :icon="['fas', 'ellipsis']" class="options-icon" />
                            </a>
                        </div>
                    </template>
                </DataTable>
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
.product-admin-nav{
    display: flex;
    justify-content: start;
    gap: 2em;
    padding-left: 20px;
    .nav-option{
        font-size: 0.875rem;
        font-weight: 400;
        color: $p-gray;
        cursor: pointer;
        border: none;
        background: none;
    }
    .selected-nav-option{
        font-size: 0.875rem;
        color: $p-black;
        border-bottom: 2px solid $p-color-500;
        font-weight: 600;
    }
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
