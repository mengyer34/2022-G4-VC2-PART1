import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import './axios-http'
import router from './router'
import { createPinia } from 'pinia'
import VueCookies from 'vue3-cookies'
import middleware from "vue-router-middleware-system"
import {store} from './stores/store'



router.beforeEach(middleware({ store }))
const app = createApp(App).use(createPinia())
app.use(store)
app.use(VueCookies)
app.use(router).mount('#app')
