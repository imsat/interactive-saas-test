<script>
import InventoryAddEditForm from "../../components/inventory/InventoryAddEditForm.vue";
import GoBackBtn from "../../components/GoBackBtn.vue";
import PageHeading from "../../components/PageHeading.vue";

export default {
    name: "InventoryUpdate",
    components: {PageHeading, GoBackBtn, InventoryAddEditForm}
}
</script>

<template>
    <PageHeading title="Inventory Edit">
        <GoBackBtn/>
    </PageHeading>
    <InventoryAddEditForm action="edit" :id="$route.params.id"></InventoryAddEditForm>
</template>

<style scoped>

</style>
