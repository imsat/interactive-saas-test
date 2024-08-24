import './bootstrap';
import {createApp} from "vue";
import router from "./routes";
import App from './pages/App.vue'
const app = createApp(App)
import '../scss/styles.scss'

app.use(router)

app.mount('#app')
