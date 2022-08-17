import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
import requestForm from "./components/user/RequestForm.vue"

const app = createApp(App)
app.component("form-requestion",requestForm)
app.use(router).mount('#app')
