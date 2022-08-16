import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/user/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/history',
    name: 'history',
    component: () => import('../views/user/history/HistoryView.vue')
  },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('../views/user/profile/ProfileView.vue')
  },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router