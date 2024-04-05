<script>
export default {
    name: "Home"
}
</script>

<template>
    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo-shadow.png" alt="" width="72" height="57">
        <h1 class="display-5 fw-bold text-body-emphasis">Simple Inventory Management</h1>
        <div class="col-lg-6 mx-auto">
            <router-link to="/inventory" class="btn btn-info">Manage Inventory</router-link>

        </div>
    </div>
</template>

<style scoped>

</style>
