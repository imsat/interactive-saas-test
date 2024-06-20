<script setup>

import PageHeading from "../../components/PageHeading.vue";
import GoBackBtn from "../../components/GoBackBtn.vue";
import InventoryAddEditForm from "../../components/inventory/InventoryAddEditForm.vue";
</script>

<template>
    <PageHeading title="Inventory Add">
        <GoBackBtn/>
    </PageHeading>
    <InventoryAddEditForm action="add"></InventoryAddEditForm>
</template>

<style scoped>

</style>
