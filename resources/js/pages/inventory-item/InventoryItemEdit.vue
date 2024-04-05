<script>
import InventoryAddEditForm from "../../components/inventory/InventoryAddEditForm.vue";
import GoBackBtn from "../../components/GoBackBtn.vue";
import PageHeading from "../../components/PageHeading.vue";
import InventoryItemAddEditForm from "../../components/inventory-item/InventoryItemAddEditForm.vue";

export default {
    name: "InventoryItemEdit",
    components: {InventoryItemAddEditForm, PageHeading, GoBackBtn}
}
</script>

<template>
    <PageHeading title="Inventory Item Edit">
        <GoBackBtn/>
    </PageHeading>
    <InventoryItemAddEditForm action="edit" :inventory-id="$route.params.inventoryId" :id="$route.params.id"></InventoryItemAddEditForm>
</template>

<style scoped>

</style>
