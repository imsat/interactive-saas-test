<script setup lang="ts">
import { useAuthStore } from '../stores/auth'
import { storeToRefs } from 'pinia'
const store = useAuthStore()
const { token, user } = storeToRefs(store)
</script>

<template>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <router-link to="/"
                             class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none fw-bold text-info h2">
                    Interactive Care
                </router-link>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li>
                        <router-link to="/inventory" class="nav-link px-2" v-if="token">Inventory Management</router-link>
                    </li>
                </ul>

                <router-link to="/login" class="btn btn-sm btn-light" v-if="!token">Login</router-link>
                <router-link to="/register" class="btn btn-sm btn-light mx-2" v-if="!token">Register</router-link>

                <div class="dropdown text-end" v-if="token">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        {{user?.name}}
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li>
                            <router-link to="/profile" class="dropdown-item">Profile</router-link>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="javascript:void(0)" @click.prevent="store.logout()">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</template>

<style scoped>

</style>
