<script>
export default {
    name: "Pagination2",
    props: {
        currentPageIndex: {
            type: Number,
            required: true
        },
        totalRecords: {
            type: Number,
            required: true
        },
        recordsPerPage: {
            type: Number,
            required: true
        }
    },
    computed: {
        totalPages() {
            return Math.ceil(this.totalRecords / this.recordsPerPage);
        }
    },
    methods: {
        setPage(pageNumber) {
            if (pageNumber >= 1 && pageNumber <= this.totalPages) {
                this.$emit('pageChanged', pageNumber);
            }
        },
        nextPage() {
            this.setPage(this.currentPageIndex + 1);
        },
        prevPage() {
            this.setPage(this.currentPageIndex - 1);
        }
    }
};
</script>

<template>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item" :class="{disabled: currentPageIndex === 1}">
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="prevPage">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item" v-for="page in totalPages" :key="page" :class="{active: currentPageIndex === page}">
                <a class="page-link" href="#" @click.prevent="setPage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="{disabled: currentPageIndex === totalPages}">
                <a class="page-link" href="#" aria-label="Next" @click.prevent="nextPage">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<style scoped>
.pagination {
    margin-top: 20px;
}

.pagination .page-item {
    display: inline-block;
    margin-right: 5px;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
    cursor: not-allowed;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: #ffffff;
}

.pagination .page-link {
    color: #007bff;
    border: 1px solid #007bff;
}

.pagination .page-link:hover {
    color: #0056b3;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.pagination .page-link:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.pagination .page-link:hover {
    z-index: 2;
    color: #0056b3;
    text-decoration: none;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}
</style>

