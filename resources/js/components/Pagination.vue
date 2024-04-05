<script>
export default {
    name: "Pagination",
    props: {
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
    },
    computed: {
        totalPages() {
            return Math.ceil(this.totalItems / this.perPage);
        },
        from() {
            return ((this.currentPage - 1) * this.perPage) + 1
        },
        to() {
            return this.totalItems > this.currentPage * this.perPage ? this.currentPage * this.perPage : this.totalItems
        }
    },
    methods: {
        setPage(pageNumber) {
            if (pageNumber >= 1 && pageNumber <= this.totalPages) {
                this.$emit('page-change', pageNumber);
            }
        },
        nextPage() {
            this.setPage(this.currentPage + 1);
        },
        prevPage() {
            this.setPage(this.currentPage - 1);
        }
    }
}
</script>

<template>
    <nav aria-label="Page navigation" class="d-flex justify-content-between">
        <p class="text-sm">Showing <b>{{ from}}</b> to <b>{{ to }}</b> of
            <b>{{ totalItems }}</b> results</p>
        <ul class="pagination">
            <li class="page-item" :class="{disabled: currentPage === 1}">
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="prevPage">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item" v-for="page in totalPages" :key="page" :class="{active: currentPage === page}">
                <a class="page-link" href="#" @click.prevent="setPage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="{disabled: currentPage === totalPages}">
                <a class="page-link" href="#" aria-label="Next" @click.prevent="nextPage">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
