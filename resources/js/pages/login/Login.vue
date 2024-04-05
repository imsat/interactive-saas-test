<script>

import {successToast} from "../../bootstrap.js";
import Spinner from "../../components/Spinner.vue";

export default {
    name: "Login",
    components: {Spinner},
    data() {
        return {
            isLoading: false,
            loginForm: {
                email: '',
                password: '',
            },
            errors: [],
        }
    },
    methods: {
        async signIn() {
            this.isLoading = true
            await axios.post('/login', this.loginForm).then(res => {
                const {token, user, message} = res.data.data
                successToast(message)
                localStorage?.setItem('token', token)
                localStorage?.setItem('user', JSON.stringify(user))
                this.loginForm = {}
                this.$router.push('/')
                location.reload()
            }).catch(errors => {
                this.setError(errors.response.data.errors);
            }).finally(() => this.isLoading = false)
        },
        setError(errors) {
            return this.errors = errors;
        },
        getError(key) {
            return !!this.errors && this.errors[key] !== undefined ? this.errors[key][0] : null;
        },
    }
}
</script>

<template>
    <div class="form-signin w-100 m-auto">
        <h2 class="h3 mb-3 fw-normal">Please sign in</h2>
        <Spinner v-if="isLoading"/>
        <form @submit.prevent="signIn">
        <div class="form-floating">
            <input type="email" class="form-control" required id="email" v-model="loginForm.email" placeholder="Email">
            <label for="email" class="required">Email address</label>
            <Validation :error-text="getError('email')" />
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" required id="password" v-model="loginForm.password"
                   placeholder="Password">
            <label for="password" class="required">Password</label>
            <Validation :error-text="getError('password')" />
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2 my-3" :disabled="isLoading">Sign in</button>
        </form>

        <p class="my-5 text-center">New member?
            <router-link to="/register" class="text-decoration-none">Register</router-link>
        </p>
    </div>
</template>


<style scoped>

</style>
