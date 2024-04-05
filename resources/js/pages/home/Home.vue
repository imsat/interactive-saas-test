<script>
import Spinner from "../../components/Spinner.vue";

export default {
    name: "Home",
    components: {Spinner}
}
</script>

<template>
    <div class="text-center py-5">
        <h1 class="text-body-emphasis">Get started with Interactive Care Inventory</h1>
        <p class="fs-5">Quickly and easily get started with Interactive Care Inventory Management, production-ready system with this barebones example featuring some basic inventory and item modules. View our example to get started.</p>

        <div class="mb-5">
            <router-link to="/inventory" class="btn btn-info btn-lg px-4">Manage Inventory</router-link>
        </div>
    </div>
</template>

<style scoped>

</style>
