//This is for test purpose not to use in nrear future.
import { reactive } from 'vue';

export const globalState = reactive({
    count: 0,
    user: {
        name: 'Guest',
        email: '',
    },
    increment() {
        this.count++;
    },
    decrement() {
        this.count--;
    },
    setUser(userData) {
        this.user = userData;
    },
});
