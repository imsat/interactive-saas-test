<script>
export default {
    name: "PageHeading",
    props: ['title']
}
</script>

<template>
    <div class="pb-3">
        <h2 class="d-inline">{{ title }}</h2>
        <div class="d-inline">
            <slot/>
        </div>
    </div>
</template>

<style scoped>
</style>
