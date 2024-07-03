import {defineStore} from 'pinia';
import {get, remove, set} from "../utils/localStorage.js";
import {post} from "../utils/fetchAPI.js";
import {errorToast, successToast} from "../utils/swalUtil.js";

interface LoginForm {
    email: string;
    password: string;
}

interface RegisterForm {
    name: string;
    email: string;
    password: string;
}

interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

interface AuthState {
    errors: Record<string, string[]>;
    token: string | null;
    user: User | null;
    loginForm: LoginForm;
    registerForm: RegisterForm;
}

export const useAuthStore = defineStore('auth', {
    state: (): AuthState => ({
        errors: {},
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
    }),
    getters: {
        getError: (state: AuthState) => (key: string): string | null => {
            return state.errors[key]?.[0] ?? null;
        },
    },
    actions: {
        async login(this: any) {
            await post('/login', this.loginForm)
                .then(res => {
                    const {token, user} = res.data.data;
                    set('token', token);
                    set('user', user);
                    this.token = token;
                    this.user = user;
                    successToast(res?.data?.message);
                    this.router.push('/');
                }).catch(err => {
                    const {errors, message} = err?.response?.data;
                    errorToast(message);
                    this.errors = errors;
                })

        },
        async register(this: any) {
            await post('/register', this.registerForm)
                .then(res => {
                    const {token, user} = res.data.data;
                    set('token', token);
                    set('user', user);
                    this.token = token;
                    this.user = user;
                    successToast(res?.data?.message);
                    this.router.push('/');
                }).catch(err => {
                    const {errors, message} = err?.response?.data;
                    errorToast(message);
                    this.errors = errors;
                })
        },
        async logout(this: any) {
            await post('/logout', null)
                .then(res => {
                    remove('token');
                    remove('user');
                    this.$reset();
                    successToast(res?.data?.message);
                    this.router.push('/login');
                }).catch(_ => {
                    errorToast('Failed to logout');
                });
        }
    }
});
