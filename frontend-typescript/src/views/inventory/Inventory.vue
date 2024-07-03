 <script setup lang="ts">
import {onBeforeMount} from "vue";
import {storeToRefs} from 'pinia'
import {useInventoryStore} from '../../stores/inventory.js'
import PageHeading from "../../components/PageHeading.vue";
import Pagination from "../../components/Pagination.vue";

const store = useInventoryStore()
const {inventories, pagination} = storeToRefs(store)

onBeforeMount(() => inventories.value.length === 0 ? store.getInventories() : '');
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
            <div class="table-responsive small">
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
<!--                            <router-link :to="{ name: 'inventoryItem', params: {inventoryId: inventory?.id} }"-->
<!--                                         class="btn btn-sm btn-info ms-2" title="Inventory Item">-->
<!--                                <i class="bi bi-building-add"></i>-->
<!--                            </router-link>-->
                            <router-link :to="{ name: 'inventoryEdit', params: {id: inventory.id} }"
                                         class="btn btn-sm btn-success ms-2" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </router-link>
                            <button type="button" class="btn btn-sm btn-danger ms-2" title="Delete"
                                    @click="store.deleteInventory(inventory?.id)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <Pagination v-if="inventories.length > 0" :current-page="pagination.current_page"
                            :total-items="pagination.total"
                            :per-page="pagination.per_page"
                            @page-change="store.getInventories"></Pagination>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
