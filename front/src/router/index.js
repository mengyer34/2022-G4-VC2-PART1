import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/user/HomeView.vue'
import HistoryView from '../views/user/history/HistoryView.vue'
import NotificatonView from '../views/user/notification/NotificationView.vue'
import ProfileView from '../views/user/profile/ProfileView.vue'


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
    path: '/notifications',
    name: 'notifications',
    component: NotificatonView
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView
  },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router