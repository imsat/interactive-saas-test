<script>
export default {
    name: "Profile",
    props: ['errorText']
}
</script>

<template>
    <span v-if="errorText" class="text-danger small" v-html="errorText"></span>
</template>

<style scoped>

</style>
