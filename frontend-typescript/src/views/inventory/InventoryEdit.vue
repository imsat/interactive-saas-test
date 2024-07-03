 <script setup lang="ts">

import PageHeading from "../../components/PageHeading.vue";
import GoBackBtn from "../../components/GoBackBtn.vue";
import InventoryAddEditForm from "../../components/inventory/InventoryAddEditForm.vue";
</script>

<template>
    <PageHeading title="Inventory Edit">
        <GoBackBtn/>
    </PageHeading>
    <InventoryAddEditForm action="edit" :id="parseInt($route.params.id as string)"></InventoryAddEditForm>
</template>

<style scoped>

</style>
