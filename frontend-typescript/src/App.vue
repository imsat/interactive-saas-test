<script setup lang="ts">
import Navbar from "./layouts/Navbar.vue";

// Test purpose
// import {provide} from "vue";
// import {globalState} from "./stores/globalState.js";
// provide('globalState', globalState);
</script>

<template>
    <Navbar/>
    <div class="container">
        <router-view/>
    </div>
</template>

<style scoped>
</style>
