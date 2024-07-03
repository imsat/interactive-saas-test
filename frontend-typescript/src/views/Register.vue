 <script setup lang="ts">
import {onBeforeUnmount} from "vue";
import {useAuthStore} from '../stores/auth'
import {storeToRefs} from 'pinia'

const store = useAuthStore()
const {registerForm} = storeToRefs(store)

onBeforeUnmount(() => {
    store.$reset()
})
// Test purpose
// import {inject} from 'vue';
// const globalState = inject('globalState');
</script>

<template>
    <div class="form-signin w-100 m-auto">
        <h2 class="h3 mb-3 fw-normal">Please register</h2>
        <form @submit.prevent="store.register">
            <div class="form-floating">
                <input type="text" class="form-control" required id="name" v-model="registerForm.name"
                       placeholder="Name">
                <label for="name" class="required">Name</label>
                <Validation :error-text="store.getError('name')"/>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" required id="email" v-model="registerForm.email"
                       placeholder="Email">
                <label for="email" class="required">Email address</label>
                <Validation :error-text="store.getError('email')"/>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" required id="password" v-model="registerForm.password"
                       placeholder="Password">
                <label for="password" class="required">Password</label>
                <Validation :error-text="store.getError('password')"/>
            </div>
            <button type="submit" class="btn btn-primary w-100 my-2">Register</button>
        </form>

        <p class="my-5 text-center">Already have an account?
            <router-link to="/login">Login</router-link>
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
