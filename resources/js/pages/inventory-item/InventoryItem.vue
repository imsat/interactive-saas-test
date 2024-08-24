<script>
import Pagination from "../../components/Pagination.vue";
import {toast} from "vue3-toastify";

export default {
    name: "InventoryItem",
    components: {Pagination},
    data() {
        return {
            isLoading: false,
            inventory: {},
            inventoryItems: [],
            pagination: {},
        }
    },
    created() {
        this.getInventoryItems()
    },
    methods: {
        async getInventoryItems(page = 1) {
            this.isLoading = true
            await axios.get(`/inventories/${this.$route.params.inventoryId}/inventoryItems`, {params: {page}})
                .then(res => {
                    let {inventory, inventory_items} = res?.data?.data
                    this.inventory = inventory
                    let {data, ...rest} = inventory_items
                    this.inventoryItems = data
                    this.pagination = rest
                }).finally(() => this.isLoading = false)
        },
        deleteInventoryItem(id) {
            if (confirm('Are you sure to delete?')) {
                this.isLoading = true
                axios.delete(`/inventories/${this.$route.params.inventoryId}/inventoryItems/${id}`)
                    .then(res => {
                        toast(res?.data?.message)
                        this.getInventoryItems()
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
            <h1 class="h2">Inventory Items</h1>
            <div>
                <router-link :to="{ name: 'inventoryItemCreate', params: {inventoryId: $route.params.inventoryId} }"
                             class="btn btn-sm btn-primary me-2" title="Create"><i
                    class="bi bi-plus-lg"></i> Create
                </router-link>
            <router-link to="/inventory" class="btn btn-sm btn-warning"><i class="bi bi-arrow-left"></i> Back</router-link>
            </div>

        </div>
        <div class="table-responsive small" v-if="!isLoading">
            <table class="table table-striped table-sm text-center">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Description</th>
                    <th scope="col" style="width: 15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(inventoryItem, i) in inventoryItems" :key="i">
                    <td>{{ inventoryItem?.id }}</td>
                    <td>{{ inventoryItem?.name }}</td>
                    <td><img :src="inventoryItem?.image" alt="Inventory item img" class="img-fluid w-25" ></td>
                    <td>{{ inventoryItem?.quantity }}</td>
                    <td>{{ inventoryItem?.description }}</td>
                    <td>
                        <router-link
                            :to="{ name: 'inventoryItemUpdate', params: { inventoryId: $route.params.inventoryId, id: inventoryItem?.id} }"
                            class="btn btn-sm btn-info me-2" title="Edit"><i class="bi bi-pencil-square"></i>
                            Edit
                        </router-link>
                        <button type="button" class="btn btn-sm btn-danger" title="Delete"
                                @click="deleteInventoryItem(inventoryItem?.id)">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
                        <Pagination :currentPageIndex="pagination.current_page" :totalRecords="pagination.total" :recordsPerPage="pagination.per_page" @pageChanged="getInventoryItems"></Pagination>
        </div>
    </main>
</template>

<style scoped>

</style>
