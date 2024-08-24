<script>
import InventoryForm from "../../components/inventory/InventoryForm.vue";

export default {
    name: "InventoryUpdate",
    components: {InventoryForm}
}
</script>

<template>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Inventory Update</h1>
            <router-link to="/inventory" class="btn btn-sm btn-warning"  title="Back"><i class="bi bi-arrow-left"></i> Back</router-link>
        </div>
        <InventoryForm operation="update" :id="$route.params.id"></InventoryForm>
    </main>
</template>

<style scoped>

</style>
