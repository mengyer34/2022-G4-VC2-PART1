import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/user/HomeView.vue'
import HistoryView from '../views/user/history/HistoryView.vue'
import NotificatonView from '../views/user/notification/NotificationView.vue'
import ProfileView from '../views/user/profile/ProfileView.vue'
import Dashboard from '../views/admin/Dashboard/DashboardView.vue'
import Students from '../views/admin/Student/StudentView.vue'
import LeaveList from '../views/admin/LeaveList/LeaveView.vue'


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
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
  {
    path: '/students',
    name: 'students',
    component: Students
  },
  {
    path: '/leaves',
    name: 'leaves',
    component: LeaveList
  },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router