<script>
export default {
    name: "Navbar",
    data() {
        return {
            token: localStorage.getItem('token')
        }
    }
}
</script>
<template>
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Interactive Care</a>
        <div class="text-end px-3" v-if="!token">
            <router-link to="/login" class="btn btn-sm btn-light text-dark me-2">Login</router-link>
            <router-link to="/register" class="btn btn-sm btn-primary">Register</router-link>
        </div>
    </header>
</template>

<style scoped>
</style>
