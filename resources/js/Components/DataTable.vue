<!-- DataTable.vue -->
<template>
    <div class="datatable-container">
        <div class="pagination">
            <div class="page-info">
                <span>{{ pageInfo }} </span>
            </div>
            <button @click="changePage(currentPage - 1)" 
                :disabled="currentPage <= 1"
                class="font-bold py-1 px-2 rounded paginate-arrow"
                :class="{ 'opacity-50 cursor-not-allowed': currentPage <= 1 }">
                <FontAwesomeIcon :icon="['fas', 'chevron-left']" class="paginate-arrow-icon" />
            </button>
            <div class="flex items-center">
                <button v-for="page in displayedPages" :key="page" @click="changePage(page)"
                    :disabled="page === currentPage"
                    class="not-selected-page"
                    :class="{ 'cursor-not-allowed selected-page': page === currentPage }">
                    {{ page }}
                </button>
            </div>
            <button @click="changePage(currentPage + 1)" :disabled="currentPage >= pageCount"
                class="font-bold py-1 px-2 rounded paginate-arrow"
                :class="{ 'opacity-50 cursor-not-allowed': currentPage >= pageCount }">
                <FontAwesomeIcon :icon="['fas', 'chevron-right']" class="paginate-arrow-icon" />
            </button>
        </div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" v-for="(header, index) in headers" :key="index"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider header-text">
                                    {{ header.text }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in paginatedItems" :key="item.id">
                                <td v-for="header in headers" class="px-6 py-4 whitespace-nowrap">
                                    <slot :name="header.value" :item="item">
                                        <div class="cell-text">{{ item[header.value] }}</div>
                                    </slot>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination">
            <div class="page-info">
                <span>{{ pageInfo }} </span>
            </div>
            <button @click="changePage(currentPage - 1)" 
                :disabled="currentPage <= 1"
                class="font-bold py-1 px-2 rounded paginate-arrow"
                :class="{ 'opacity-50 cursor-not-allowed': currentPage <= 1 }">
                <FontAwesomeIcon :icon="['fas', 'chevron-left']" class="paginate-arrow-icon" />
            </button>
            <div class="flex items-center">
                <button v-for="page in displayedPages" :key="page" @click="changePage(page)"
                    :disabled="page === currentPage"
                    class="not-selected-page"
                    :class="{ 'cursor-not-allowed selected-page': page === currentPage }">
                    {{ page }}
                </button>
            </div>
            <button @click="changePage(currentPage + 1)" :disabled="currentPage >= pageCount"
                class="font-bold py-1 px-2 rounded paginate-arrow"
                :class="{ 'opacity-50 cursor-not-allowed': currentPage >= pageCount }">
                <FontAwesomeIcon :icon="['fas', 'chevron-right']" class="paginate-arrow-icon" />
            </button>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        headers: {
            type: Array,
            required: true
        },
        items: {
            type: Array,
            required: true
        },
        perPage: {
            type: Number,
            default: 25
        }
    },
    data() {
        return {
            currentPage: 1,
            start: 1,
            end: 25
        }
    },
    watch: {
        //
    },
    computed: {
        pageCount() {
            return Math.ceil(this.items.length / this.perPage);
        },
        paginatedItems() {
            let itemsPerPage = parseInt(this.perPage);
            this.start = (this.currentPage - 1) * itemsPerPage;
            this.end = Math.min(this.start + itemsPerPage, this.items.length);
            return this.items.slice(this.start, this.end);
        },
        displayedPages() {
            const total = 5;
            let start = this.currentPage - Math.floor(total / 2);
            start = Math.max(start, 1);
            let end = start + total - 1;
            end = Math.min(end, this.pageCount);
            start = Math.max(end - total + 1, 1);
            return Array.from({ length: end - start + 1 }, (v, i) => i + start);
        },
        pageInfo() {
            return `${this.start} - ${this.end} of ${this.items.length} items`;
        }
    },
    methods: {
        changePage(page) {
            if (page >= 1 && page <= this.pageCount) {
                this.currentPage = page;
            }
        },
        nextPage() {
            this.changePage(this.currentPage + 1);
        },
        previousPage() {
            this.changePage(this.currentPage - 1);
        }
    }
}
</script>

<style lang="scss">
@import '../../sass/variables.scss';


.header-text{
    color: $p-color-800;
    font-size: 14px;
}
.cell-text{
    font-size: 14px;
    color: $p-color-800;
}
.pagination {
    display: flex;
    justify-content: end;
    align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;
}
.paginate-arrow{
    background-color: $p-color-300;
    color: black;
    border-radius: 5px;
    padding: 4px 8px;
    margin-left: 8px;
    margin-right: 8px;
    .paginate-arrow-icon{
        color: $p-color-800;
    }
    &:hover{
        background-color: $p-color-700;
        // color: rgb(206, 26, 26);
        .paginate-arrow-icon{
            color: white;
        }
    }
}
.not-selected-page{
    background-color: $p-color-200;
    color: $p-color-800;
    border-radius: 5px;
    padding: 4px 8px;
    margin: 3px;
    &:hover{
        background-color: $p-color-500;
        color: white;
    }
}
.selected-page{
    background-color: $p-color-700;
    color: white;
    border-radius: 5px;
    padding: 5px 10px;
    margin: 3px;
}
.page-info{
    margin-right:10px;
    span{
        font-size: 14px;
        font-weight: 400;
        color: #818181;
    }
}
</style>