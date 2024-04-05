<script>
import Pagination from "../../components/Pagination.vue";
import PageHeading from "../../components/PageHeading.vue";
import GoBackBtn from "../../components/GoBackBtn.vue";
import InventoryItemAddEditForm from "../../components/inventory-item/InventoryItemAddEditForm.vue";

export default {
    name: "InventoryItemAdd",
    components: {InventoryItemAddEditForm, GoBackBtn, PageHeading, Pagination}
}
</script>

<template>
    <PageHeading title="Inventory Item Add">
        <GoBackBtn/>
    </PageHeading>
    <InventoryItemAddEditForm action="add"  :inventory-id="$route.params.inventoryId"></InventoryItemAddEditForm>
</template>

<style scoped>

</style>
