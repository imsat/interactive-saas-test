<script>
import Pagination from "../../components/Pagination.vue";
import {toast} from "vue3-toastify";

export default {
    name: "Inventory",
    components: {Pagination},
    data() {
        return {
            isLoading: false,
            inventories: [],
            pagination: {},
        }
    },
    created() {
        this.getInventories()
    },
    methods: {
        async getInventories(page = 1) {
            // const payload = {page}
            this.isLoading = true
            await axios.get('/inventories', {params: {page}})
                .then(res => {
                    let {data, ...rest} = res?.data?.data
                    this.inventories = data
                    this.pagination = rest
                }).finally(() => this.isLoading = false)
        },
        deleteInventory(id) {
            if (confirm('Are you sure to delete?')) {
                this.isLoading = true
                axios.delete(`/inventories/${id}`)
                    .then(res => {
                        toast(res?.data?.message)
                        this.getInventories()
                    }).finally(() => this.isLoading = false)
            }
        }
    }
}
</script>

<template>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Inventory</h1>
            <router-link to="/inventory/create" class="btn btn-sm btn-primary" title="Create"><i
                class="bi bi-plus-lg"></i> Create
            </router-link>
        </div>
        <div class="table-responsive small" v-if="!isLoading">
            <table class="table table-striped table-sm text-center">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(inventory, i) in inventories" :key="i">
                    <td>{{ inventory?.id }}</td>
                    <td>{{ inventory?.name }}</td>
                    <td>{{ inventory?.description }}</td>
                    <td>
                        <router-link :to="{ name: 'inventoryItem', params: {inventoryId: inventory?.id} }"
                                     class="btn btn-sm btn-primary me-2" title="Inventory Item"><i class="bi bi-boxes"></i>
                            Item
                        </router-link>
                        <router-link :to="{ name: 'inventoryUpdate', params: {id: inventory?.id} }"
                                     class="btn btn-sm btn-info me-2" title="Edit"><i class="bi bi-pencil-square"></i>
                            Edit
                        </router-link>
                        <button type="button" class="btn btn-sm btn-danger" title="Delete"
                                @click="deleteInventory(inventory?.id)">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <Pagination :currentPageIndex="pagination.current_page" :totalRecords="pagination.total"
                        :recordsPerPage="pagination.per_page" @pageChanged="getInventories"></Pagination>
        </div>
    </main>
</template>

<style scoped>

</style>
