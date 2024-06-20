<script setup>
import {computed, toRefs} from 'vue';
// Props
const props = defineProps({
    currentPage: {
        type: Number,
        required: true
    },
    totalItems: {
        type: Number,
        required: true
    },
    perPage: {
        type: Number,
        required: true
    }
});

const { currentPage, totalItems, perPage } = toRefs(props);

// Computed properties
const totalPages = computed(() => Math.ceil(totalItems.value / perPage.value));
const from = computed(() => ((currentPage.value - 1) * perPage.value) + 1);
const to = computed(() => totalItems.value > currentPage.value * perPage.value ? currentPage.value * perPage.value : totalItems.value);

//Methods
// Methods
function setPage(pageNumber) {
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

// Emit event
const emit = defineEmits(['page-change']);
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
                <a class="page-link" href="#" @click.prevent="setPage(page)">{{ page }}</a>
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

</style>
