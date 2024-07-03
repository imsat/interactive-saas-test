import { createApp } from 'vue';
import { createPinia } from 'pinia';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './style.css';
import router from "./router";
import { piniaPluginRouter } from './plugins/piniaPluginRouter';
import App from './App.vue';
import Validation from "./components/Validation.vue";

const app = createApp(App);
const pinia = createPinia();
pinia.use(piniaPluginRouter);

app.use(pinia);
app.use(router);
app.component('Validation', Validation);
app.mount('#app');
