import './bootstrap';
import  {createApp} from "vue";
import '../scss/styles.scss'

import App from './pages/App.vue'
import Validation from './components/Validation.vue'
import router from "./routes";
const app = createApp(App)

app.use(router)
app.component('Validation', Validation)
app.mount('#app')
