<script>
import PageHeading from "../../components/PageHeading.vue";
import Pagination from "../../components/Pagination.vue";
import {confirm, successToast} from "../../bootstrap.js";
import GoBackBtn from "../../components/GoBackBtn.vue";
import Spinner from "../../components/Spinner.vue";

export default {
    name: "Inventory Item",
    components: {Spinner, GoBackBtn, Pagination, PageHeading},
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
            const payload = {page}
            this.isLoading = true
            await axios.get(`/inventories/${this.$route.params.inventoryId}/inventoryItems`, {params: payload})
                .then(res => {
                    let {inventory, inventory_items} = res?.data?.data
                    this.inventory = inventory
                    let {data, ...rest} = inventory_items
                    this.inventoryItems = data
                    this.pagination = rest
                }).catch(errors => {
                    //
                }).finally(() => this.isLoading = false)
        },
        deleteInventory(id) {
            confirm().then(result => {
                if (result.value) {
                    this.isLoading = true
                    axios.delete(`/inventories/${this.$route.params.inventoryId}/inventoryItems/${id}`)
                        .then(res => {
                            successToast(res?.data?.message)
                            this.getInventoryItems()
                        }).catch(errors => {
                        //
                    }).finally(() => this.isLoading = false)
                }
            });
        }
    }
}
</script>

<template>
    <PageHeading title="Inventory Item Management">
        <GoBackBtn/>
    </PageHeading>
    <div class="card shadow">
        <div class="card-header border-0">
            All Inventory Items for <b>{{ inventory?.name }}</b>
            <router-link :to="{ name: 'inventoryItemAdd', params: {inventoryId: $route.params.inventoryId} }"
                         class="btn btn-sm btn-info float-end" title="Add"><i
                class="bi bi-plus-lg"></i> Add New
            </router-link>
        </div>
        <div class="card-body">
            <Spinner v-if="isLoading"/>
            <div class="table-responsive small" v-else>
                <table class="table table-sm table-bordered text-center align-middle">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 5%">Id</th>
                        <th scope="col" style="width: 25%">Name</th>
                        <th scope="col" style="width: 10%">Quantity</th>
                        <th scope="col" style="width: 20%">Image</th>
                        <th scope="col" style="width: 30%">Description</th>
                        <th scope="col" style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(inventoryItem, i) in inventoryItems" :key="i">
                        <th scope="row">{{ inventoryItem?.id }}</th>
                        <td>{{ inventoryItem?.name }}</td>
                        <td>{{ inventoryItem?.quantity }}</td>
                        <td><img :src="inventoryItem?.image" alt="Inventory item img" class="img-fluid w-25"></td>
                        <td>{{ inventoryItem?.description }}</td>
                        <td>
                            <router-link :to="{ name: 'inventoryItemEdit', params: {id: inventoryItem?.id} }"
                                         class="btn btn-sm btn-success me-2" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </router-link>
                            <button type="button" class="btn btn-sm btn-danger me-2" title="Delete"
                                    @click="deleteInventory(inventoryItem?.id)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <Pagination :current-page="pagination.current_page" :total-items="pagination.total"
                            :per-page="pagination.per_page" @page-change="getInventoryItems"></Pagination>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
