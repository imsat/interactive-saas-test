<script>
import PageHeading from "../../components/PageHeading.vue";
import Pagination from "../../components/Pagination.vue";
import {confirm, successToast} from "../../bootstrap.js";

export default {
    name: "Inventory",
    components: {Pagination, PageHeading},
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
            const payload = {page}
            this.isLoading = true
            await axios.get('/inventories', {params: payload})
                .then(res => {
                    let {data, ...rest} = res?.data?.data
                    this.inventories = data
                    this.pagination = rest
                }).catch(errors => {
                    //
                }).finally(() => this.isLoading = false)
        },
        deleteInventory(id) {
            confirm().then(result => {
                if (result.value) {
                    this.isLoading = true
                    axios.delete(`/inventories/${id}`)
                        .then(res => {
                            successToast(res?.data?.message)
                            this.getInventories()
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
    <PageHeading title="Inventory Management"/>
    <div class="card shadow">
        <div class="card-header border-0">
            All Inventories
            <router-link to="/inventory/add" class="btn btn-sm btn-info float-end" title="Add"><i
                class="bi bi-plus-lg"></i> Add New
            </router-link>
        </div>
        <div class="card-body">
            <div class="table-responsive small" v-if="!isLoading">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col" style="width: 40%">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(inventory, i) in inventories" :key="i">
                        <th scope="row">{{ inventory?.id }}</th>
                        <td>{{ inventory?.name }}</td>
                        <td>{{ inventory?.description }}</td>
                        <td>
                            <router-link :to="{ name: 'inventoryItem', params: {inventoryId: inventory?.id} }"
                                         class="btn btn-sm btn-info ms-2" title="Inventory Item">
                                <i class="bi bi-building-add"></i>
                            </router-link>
                            <router-link :to="{ name: 'inventoryEdit', params: {id: inventory?.id} }"
                                         class="btn btn-sm btn-success ms-2" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </router-link>
                            <button type="button" class="btn btn-sm btn-danger ms-2" title="Delete"
                                    @click="deleteInventory(inventory?.id)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <Pagination :current-page="pagination.current_page" :total-items="pagination.total"
                            :per-page="pagination.per_page" @page-change="getInventories"></Pagination>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
