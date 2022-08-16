import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/user/HomeView.vue'
import NewRequest from '../views/user/NewRequest/NewRequest.vue'
import HistoryView from '../views/user/history/HistoryView.vue'
import NotificatonView from '../views/user/notification/NotificationView.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/histories',
    name: 'histories',
    component: HistoryView
  },
  {
    path: '/newRequest',
    name: 'newRequest',
    component: NewRequest
  },
  {
    path: '/notifications',
    name: 'notifications',
    component: NotificatonView
  },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router