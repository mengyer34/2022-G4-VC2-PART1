import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'




const app = createApp(App).use(createPinia())
app.use(router).mount('#app')
