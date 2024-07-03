<script setup lang="ts">
    const props = defineProps(['errorText'])
</script>

<template>
    <span v-if="props.errorText" class="text-danger small" v-html="props.errorText"></span>
</template>

<style scoped>

</style>
