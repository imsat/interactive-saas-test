<script>
import Navbar from "../Navbar.vue";
export default {
    name: "PrivateLayout",
    components: {
        Navbar,
    },
}
</script>

<template>
    <Navbar/>
    <slot/>
</template>

<style scoped>

</style>
