<script>
import InventoryItemForm from "../../components/inventory-item/InventoryItemForm.vue";

export default {
    name: "InventoryUpdate",
    components: {InventoryItemForm}
}
</script>

<template>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Inventory Item Update</h1>
            <router-link to="/inventory" class="btn btn-sm btn-warning" title="Create"><i class="bi bi-arrow-left"></i>
                Back
            </router-link>
        </div>
        <InventoryItemForm operation="update" :inventoryId="$route.params.inventoryId"
                           :id="$route.params.id"></InventoryItemForm>
    </main>
</template>

<style scoped>

</style>
