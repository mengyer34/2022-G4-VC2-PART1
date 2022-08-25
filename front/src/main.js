import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import './axios-http'
import router from './router'
import { createPinia } from 'pinia'
import VueCookies from 'vue-cookies'
import TheNavigation from './components/navigation/TheNavigation.vue';
import AdminNavDrawer from './components/navigation/AdminNavDrawer.vue';



const app = createApp(App).use(createPinia())
app.use(VueCookies)
app.use(router).mount('#app')
