import { useRouter, Router } from 'vue-router';
import { PiniaPluginContext } from 'pinia';

declare module 'pinia' {
    export interface PiniaCustomProperties {
        router: Router;
    }
}

export const piniaPluginRouter = ({ store }: PiniaPluginContext) => {
    store.router = useRouter();
};
