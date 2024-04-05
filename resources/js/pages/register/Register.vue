<script>
import {successToast} from "../../bootstrap.js";
import Spinner from "../../components/Spinner.vue";

export default {
    name: "Register",
    components: {Spinner},
    data() {
        return {
            isLoading: false,
            registerForm: {
                name: '',
                email: '',
                password: '',
            },
            errors: [],
        }
    },
    methods: {
        async register() {
            this.isLoading = true
            await axios.post('/register', this.registerForm).then(res => {
                const {token, user, message} = res.data.data
                successToast(message)
                localStorage?.setItem('token', token)
                localStorage?.setItem('user', JSON.stringify(user))
                this.registerForm = {}
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
        <h2 class="h3 mb-3 fw-normal">Please register</h2>
        <Spinner v-if="isLoading"/>
        <form @submit.prevent="register">
            <div class="form-floating">
                <input type="text" class="form-control" required id="floatingName" v-model="registerForm.name"
                       placeholder="Name">
                <label for="floatingName">Name</label>
                <Validation :error-text="getError('name')"/>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" required id="floatingInput" v-model="registerForm.email"
                       placeholder="Email">
                <label for="floatingInput">Email address</label>
                <Validation :error-text="getError('email')"/>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" required id="floatingPassword" v-model="registerForm.password"
                       placeholder="Password">
                <label for="floatingPassword">Password</label>
                <Validation :error-text="getError('password')"/>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 my-3" :disabled="isLoading">Register</button>
        </form>

        <p class="my-5 text-center">Already have an account?
            <router-link to="/login" class="text-decoration-none">Login</router-link>
        </p>
    </div>
</template>

<style scoped>

</style>
