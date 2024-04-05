<script>
import Pagination from "../../components/Pagination.vue";
import InventoryAddEditForm from "../../components/inventory/InventoryAddEditForm.vue";
import PageHeading from "../../components/PageHeading.vue";
import GoBackBtn from "../../components/GoBackBtn.vue";

export default {
    name: "InventoryAdd",
    components: {GoBackBtn, PageHeading, InventoryAddEditForm, Pagination}
}
</script>

<template>
    <PageHeading title="Inventory Add">
        <GoBackBtn/>
    </PageHeading>
    <InventoryAddEditForm action="add"></InventoryAddEditForm>
</template>

<style scoped>

</style>
