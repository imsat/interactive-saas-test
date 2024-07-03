<script setup lang="ts">

</script>

<template>
    <button type="button" class="btn btn-primary btn-sm float-end" @click="$router.go(-1)"><i
        class="bi bi-arrow-left"></i> Back
    </button>
    <slot/>
</template>

<style scoped>

</style>
