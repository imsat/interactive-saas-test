import {defineStore} from 'pinia'
import {get, remove, set} from "../utils/localStorage.js";
import {post} from "../utils/fetchAPI.js";
import {errorToast, successToast} from "../utils/swalUtil.js";

export const useAuthStore = defineStore('auth', {
    state: () => {
        return {
            errors: [],
            token: get('token') || null,
            user: get('user') || null,
            loginForm: {
                email: '',
                password: '',
            },
            registerForm: {
                name: '',
                email: '',
                password: '',
            }
        }
    },
    getters: {
        getError: (state) => {
            return (key) => !!state.errors && state.errors[key] !== undefined ? state.errors[key][0] : null
        },
    },
    actions: {
        async login() {
            await post('/login', this.loginForm)
                .then(res => {
                    const {token, user} = res.data.data
                    set('token', token)
                    set('user', user)
                    this.token = token
                    this.user = user
                    successToast(res?.data?.message)
                    this.router.push('/')
                }).catch(err => {
                    const {errors, message} = err?.response?.data
                    errorToast(message)
                    this.errors = errors
                })

        },
        async register() {
            await post('/register', this.registerForm)
                .then(res => {
                    const {token, user} = res.data.data
                    set('token', token)
                    set('user', user)
                    this.token = token
                    this.user = user
                    successToast(res?.data?.message)
                    this.router.push('/')
                })
                .catch(err => {
                    const {errors, message} = err?.response?.data
                    errorToast(message)
                    this.errors = errors
                })
        },
        async logout() {
            await post('/logout').then(res => {
                remove('token')
                remove('user')
                // Resetting the state
                this.$reset();
                successToast(res?.data?.message)
                this.router.push('/login');
            })

        }
    }
})
