<script setup>
import {onBeforeUnmount} from "vue";
import {storeToRefs} from 'pinia'
import {useAuthStore} from '../stores/auth'

const store = useAuthStore()
const {loginForm, errors} = storeToRefs(store)

onBeforeUnmount(() => {
    store.$reset()
})

// Test purpose
// import { inject } from 'vue';
// const globalState = inject('globalState');
</script>

<template>
    <div class="form-signin w-100 m-auto">
        <h2 class="h3 mb-3 fw-normal">Please sign in</h2>
        <div class="form-floating">
            <input type="email" class="form-control" required id="email" v-model="loginForm.email" placeholder="Email">
            <label for="email" class="required">Email address</label>
            <Validation :error-text="store.getError('email')"/>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" required id="password" v-model="loginForm.password"
                   placeholder="Password">
            <label for="password" class="required">Password</label>
            <Validation :error-text="store.getError('password')"/>
        </div>

        <button type="button" class="btn btn-primary w-100 my-2" @click="store.login()">Sign in</button>

        <p class="my-5 text-center">New member?
            <router-link to="/register">Register</router-link>
        </p>

<!--        <div>-->
<!--            <h2>Counter: {{ globalState.count }}</h2>-->
<!--            <button @click="globalState.increment">Increment</button>-->
<!--            <button @click="globalState.decrement">Decrement</button>-->
<!--        </div>-->
    </div>
</template>

<style scoped>

</style>
