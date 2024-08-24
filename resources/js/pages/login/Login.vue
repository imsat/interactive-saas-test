<script>
export default {
    name: "Login",
    data() {
        return {
            loginForm: {
                email: '',
                password: '',
            },
            errors: [],
        }
    },
    methods: {
        signIn() {
            axios.post('/login', this.loginForm).then(res => {
                const {token, user} = res.data.data
                localStorage?.setItem('token', token)
                localStorage?.setItem('user', JSON.stringify(user))
                this.loginForm = {}
                this.$router.push('/')
                location.reload() //Need to work on this #solution pinia or https://stackoverflow.com/questions/63471824/vue-js-3-event-bus
            }).catch(errors => {
                this.setError(errors.response.data.errors);
            })
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
        <div class="mb-2">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Email" v-model="loginForm.email">
            <span class="text-danger" v-if="getError('email')">{{ getError('email') }}</span>
        </div>
        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password"
                   v-model="loginForm.password">
            <span class="text-danger" v-if="getError('password')">{{ getError('password') }}</span>
        </div>

        <button type="button" class="btn btn-primary w-100 my-2" @click.prevent="signIn">Sign in</button>

        <p class="my-5 text-center">New member?
            <router-link to="/register">Register</router-link>
        </p>
    </div>
</template>

<style scoped>

</style>
