<script setup lang="ts">
import { computed, toRefs } from 'vue';

// Props
interface Props {
    currentPage: number;
    totalItems: number;
    perPage: number;
}

const props = defineProps<Props>();

const { currentPage, totalItems, perPage } = toRefs(props);

// Computed properties
const totalPages = computed(() => Math.ceil(totalItems.value / perPage.value));
const from = computed(() => ((currentPage.value - 1) * perPage.value) + 1);
const to = computed(() => totalItems.value > currentPage.value * perPage.value ? currentPage.value * perPage.value : totalItems.value);

// Emit event
const emit = defineEmits<{
    (e: 'page-change', pageNumber: number): void;
}>();

// Methods
function setPage(pageNumber: number) {
    if (pageNumber >= 1 && pageNumber <= totalPages.value) {
        emit('page-change', pageNumber);
    }
}

function nextPage() {
    setPage(currentPage.value + 1);
}

function prevPage() {
    setPage(currentPage.value - 1);
}
</script>

<template>
    <nav aria-label="Page navigation" class="d-flex justify-content-between">
        <p class="text-sm">Showing <b>{{ from }}</b> to <b>{{ to }}</b> of
            <b>{{ totalItems }}</b> results</p>
        <ul class="pagination">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="prevPage">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                <a class="page-link" :class="{'custom-disabled-link': currentPage === page}" href="javascript:void(0)" @click.prevent="setPage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <a class="page-link" href="#" aria-label="Next" @click.prevent="nextPage">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<style scoped>
.custom-disabled-link {
    pointer-events: none;
    text-decoration: none;
}
</style>
