<template>
    <Navbar/>
    <div class="container-fluid">
        <div class="row">
            <Sidebar />
            <slot/>
        </div>
    </div>
</template>

<script>
import Navbar from "../Navbar.vue";
import Sidebar from "../Sidebar.vue";

export default {
    name: "PrivateLayout",
    components: {
        Navbar,
        Sidebar
    },
}
</script>
<style scoped>

</style>
